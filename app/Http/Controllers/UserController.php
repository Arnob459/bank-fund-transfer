<?php

namespace App\Http\Controllers;

use App\Lib\GoogleAuthenticator;
use App\Rules\FileTypeValidate;
use App\Models\Setting;
use App\Models\Trx;
use App\Models\User;
use App\Models\Transfer;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Account;
use App\Models\CardType;
use App\Models\Card;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use Carbon\Carbon;


class UserController extends Controller
{

    public function profile()
    {
        $page_title = 'Profile';
        $user = Auth::user();
        return view('user.profile.index', compact('page_title','user'));
    }


    public function kycUpdate(Request $request)
    {
        $request->validate([
            'nid' => 'required|image|mimes:jpeg,png,jpg|max:2024',
            'passport' => 'required|image|mimes:jpeg,png,jpg|max:2024',
        ]);

        if ($request->hasFile('nid')) {
            try {
                $path = config('constants.nid.path');
                $size = config('constants.nid.size');
                $old_image = null;
                $filename = upload_image($request->nid, $path, $size,$old_image);
            } catch (\Exception $exp) {
                return back()->withWarning('Image could not be uploaded');
            }
        }

        if ($request->hasFile('passport')) {
            try {
                $path = config('constants.passport.path');
                $size = config('constants.passport.size');
                $old_image = null;
                $filename2 = upload_image($request->passport, $path, $size,$old_image);
            } catch (\Exception $exp) {
                return back()->withWarning('Image could not be uploaded');
            }
        }

        auth()->user()->update([
            'nid' => $filename,
            'passport' => $filename2,
            'kyc_verify' => 2,

        ]);
        return back()->with('success', 'Kyc information submitted successfully');
    }


    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|max:160',
            'address' => 'nullable|max:160',
            'city' => 'nullable|max:160',
            'state' => 'nullable|max:160',
            'zip' => 'nullable|max:160',
            'country' => 'nullable|max:160',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2024',

        ]);

        $filename = auth()->user()->avatar;
        if ($request->hasFile('avatar')) {
            try {
                $path = config('constants.user.profile.path');
                $size = config('constants.user.profile.size');
                $filename = upload_image($request->avatar, $path, $size, $filename);
            } catch (\Exception $exp) {
                return back()->withErrors( 'Image could not be uploaded');
            }
        }

        auth()->user()->update([
            'name' => $request->name,
            'avatar' => $filename,

            'address' => [
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,

            ]
        ]);
        return back()->with('success', 'Your profile has been updated');
    }

    public function contactUpdate(Request $request)
    {
        $userId = auth()->user()->id;

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => 'required|max:20|unique:users,phone,' . $userId,
        ]);

        auth()->user()->update([
            'email' => $request->email,
            'phone' => $request->phone,

        ]);
        return back()->with('success', 'Your Contact has been updated');
    }

    public function avatarUpdate(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpg,jpeg,png',
        ]);

        $filename = auth()->user()->avatar;
        if ($request->hasFile('avatar')) {
            try {
                $path = config('constants.user.profile.path');
                $size = config('constants.user.profile.size');
                $filename = upload_image($request->avatar, $path, $size, $filename);
            } catch (\Exception $exp) {
                return back()->withErrors( 'Image could not be uploaded');
            }
        }

        auth()->user()->update([
            'avatar' => $filename,
        ]);
        return back()->with('success', 'Your Avatar has been updated');
    }


    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|max:160|min:6'
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->withErrors('Your old password doesnot match');
        }
        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);
        // $notify[] = ['success', 'Your password has been updated'];
        return back()->with('success', 'Your password has been updated');
    }



    public function PendingRequest()
    {
        $page_title = 'All Requests';
        $requests = Transfer::where('type', 0)->where('receiver_id', auth()->user()->id)->with(['user','bank'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No request is pending';
        return view('user.request.requests', compact('page_title', 'requests', 'empty_message'));
    }


    public function requestApprove(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $user = auth()->user();

        $transfer = Transfer::where('id',$request->id)->where('status',2)->firstOrFail();
        if ($user->balance < $transfer->final_amount) {
            return back()->withErrors( 'Insufficient Balance');

        }
        $transfer->status = 4;
        $transfer->save();

        if ($transfer->amount > $transfer->final_amount) {
            $user->balance -= formatter_money($transfer->amount);

        } else {
            $user->balance -= formatter_money($transfer->final_amount);
        }

        $user->save();

        return back()->with('success', 'Request accepted wait for admin approval.');
    }

    public function requestReject(Request $request)
    {
        $general = Setting::first();
        $request->validate(['id' => 'required|integer']);
        $transfer = Transfer::where('id',$request->id)->where('status',2)->firstOrFail();
        $transfer->status = 3;
        $transfer->admin_feedback = 'Receiver Rejected ';
        $transfer->save();

        return back()->with('success', 'Request has been rejected.');
    }

    public function requestMoneyOwnBank()
    {
        $data['page_title'] = "Request Money";
        return view('user.own_bank.request_money', $data);
    }

    public function requestMoneyConfirmOwnBank(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:6|max:50',
            'amount' => 'required|numeric|gt:0||lt:10000000000000000.00',
        ]);

        $username = User::where('username',$request->username)->where('status',1)->first();

        if ($username) {
            if ($username->id == auth()->user()->id) {
                return back()->withErrors('Please input other Username');
            }
            $data['username'] = $username;
        } else {
            return back()->withErrors('Please input Valid Username');

        }

        $genaral = Setting::first();
        $charge = $genaral->fixed_charge + ($request->amount * $genaral->percent_charge / 100);
        if ($charge < $request->amount) {
            $afterCharge = $request->amount - $charge;
        } else {
            return back()->withErrors('Please enter greater amount that charges');

        }

        $data['page_title'] = "Confirm Request Money";
        $data['amount'] = $request->amount;
        $data['who'] = $request->who;
        $data['charge'] = $charge;
        $data['after_charge'] = $afterCharge ;




        return view('user.own_bank.request_money_confirm', $data);
    }

    public function requestMoneySubmitOwnBank(Request $request)
    {

        $this->validate($request, [
            'username' => 'required|string|min:6|max:50',
            'amount' => 'required|numeric|gt:0||lt:10000000000000000.00',
        ]);
        $username = User::where('username',$request->username)->where('status',1)->pluck('id')->first();
            if ($username) {
                if ($username == auth()->user()->id) {
                    return back()->withErrors('Please input other Username');
                }
                $receiver = $username;
            } else {
                return back()->withErrors('Please input Valid Username');

            }

        $user = auth()->user();


        $exists = Transfer::where('user_id', $user->id)->where('receiver_id', $username)->where('type', 0)->where('status', 2)->exists();

        if ($exists) {
            return redirect()->route('user.ownbank.requestmoney')->withErrors('You cannot send request again your previous request is still pending');
        }

        $genaral = Setting::first();



        if ($request->who == 0) {

            $charge = $genaral->fixed_charge + ($request->amount * $genaral->percent_charge / 100);
            $afterCharge = $request->amount + $charge;

            $transfer = new Transfer();
            $transfer->user_id = $user->id;
            $transfer->bank_id = 0;
            $transfer->receiver_id = $receiver;
            $transfer->trx = getTrx();
            $transfer->amount = formatter_money($request->amount);
            $transfer->chart_amount += formatter_money($request->amount);
            $transfer->charge = $charge;
            $transfer->type = 0;
            $transfer->bank_type = 2;
            $transfer->after_charge = $afterCharge;
            $transfer->final_amount = $afterCharge;
            $transfer->status = 2;
            $transfer->save();


            Trx::create([
                'user_id' => $transfer->user_id,
                'receiver_id' => $receiver,
                'amount' => $transfer->amount,
                'post_balance' => $user->balance + $transfer->amount,
                'charge' => $transfer->charge,
                'trx_type' => '-',
                'remark' => 'request-money',
                'details' => 'request to ' . $transfer->receiver->name,
                'trx' => $transfer->trx,
                'type' => 1
            ]);
            $data['username'] = $request->username;
            $data['amount'] = $transfer->amount;
            return view('user.own_bank.request_money_success', $data);
        }
        if ($request->who == 1) {

            $charge = $genaral->fixed_charge + ($request->amount * $genaral->percent_charge / 100);
            if ($charge < $request->amount) {
                $afterCharge = $request->amount - $charge;
            } else {
                return redirect()->route('user.ownbank.requestmoney')->withErrors('Please enter greater amount that charges');

            }

            $transfer = new Transfer();
            $transfer->user_id = $user->id;
            $transfer->bank_id = 0;
            $transfer->receiver_id = $receiver;
            $transfer->trx = getTrx();
            $transfer->amount = formatter_money($request->amount);
            $transfer->chart_amount += formatter_money($request->amount);
            $transfer->charge = $charge;
            $transfer->type = 0;
            $transfer->bank_type = 2;
            $transfer->after_charge = $afterCharge;
            $transfer->final_amount = $afterCharge;
            $transfer->status = 2;
            $transfer->save();


            Trx::create([
                'user_id' => $transfer->user_id,
                'receiver_id' => $receiver,
                'amount' => $transfer->amount,
                'post_balance' => $user->balance + $transfer->after_charge,
                'charge' => $transfer->charge,
                'trx_type' => '-',
                'remark' => 'request-money',
                'details' => 'request to ' . $transfer->receiver->name,
                'trx' => $transfer->trx,
                'type' => 1
            ]);

            $data['username'] = $request->username;
            $data['amount'] = $transfer->amount;

            return view('user.own_bank.request_money_success', $data);

        }

    }

    public function sendMoneyOwnBank(Request $request)
    {
        $data['page_title'] = "Send Money";
        return view('user.own_bank.send_money', $data);
    }

    public function sendMoneyOwnBankC()
    {
        return redirect()->route('user.ownbank.sendmoney');
    }


    public function sendMoneyConfirmOwnBank(Request $request)
    {

        $this->validate($request, [
            'username' => 'required|string|min:6|max:50',
            'amount' => 'required|numeric|gt:0',
        ]);

        if (auth()->user()->balance < $request->amount) {
            return back()->withErrors('Insufficient balance');
        }

        $username = User::where('username',$request->username)->where('status',1)->first();


        if ($username) {
            if ($username->id == auth()->user()->id) {
                return back()->withErrors('Please input Other Username');
            }
            $data['username'] = $username;
        } else {
            return back()->withErrors('Please input Valid Username');

        }

        $genaral = Setting::first();
        $charge = $genaral->fixed_charge + ($request->amount * $genaral->percent_charge / 100);

        if ($charge < $request->amount) {
            $afterCharge = $request->amount - $charge;
        } else {
            return back()->withErrors('Please enter greater amount that charges');

        }

        $data['page_title'] = "Confirm Send Money";
        $data['amount'] = $request->amount;
        $data['charge'] = $charge;
        $data['after_charge'] = $afterCharge ;


        return view('user.own_bank.send_money_confirm', $data);
    }

    public function sendMoneySubmitOwnBank(Request $request)
    {
        if (session()->has('form_submitted')) {
            // Handle the case where the form has already been submitted
            // Redirect back or show an error message
        $this->validate($request, [
            'username' => 'required|string|min:6|max:50',
            'amount' => 'required|numeric|gt:0',
        ]);
        $username = User::where('username',$request->username)->where('status',1)->pluck('id')->first();
            if ($username) {
                if ($username == auth()->user()->id) {
                    return redirect()->route('user.ownbank.sendmoney')->withErrors('Please input other Username');
                }
                $receiver = $username;
            } else {
                return redirect()->route('user.ownbank.sendmoney')->withErrors('Please input Valid Username');

            }

        $user = auth()->user();

        if ($user->balance < $request->amount) {
            return redirect()->route('user.ownbank.sendmoney')->withErrors('Insufficient balance');
        }

        $genaral = Setting::first();

        $charge = $genaral->fixed_charge + ($request->amount * $genaral->percent_charge / 100);

        if ($charge < $request->amount) {
            $afterCharge = $request->amount - $charge;
        } else {
            return redirect()->route('user.ownbank.sendmoney')->withErrors('Please enter greater amount that charges');

        }


        $transfer = new Transfer();
        $transfer->user_id = $user->id;
        $transfer->bank_id = 0;
        $transfer->receiver_id = $receiver;
        $transfer->trx = getTrx();
        $transfer->amount = formatter_money($request->amount);
        $transfer->chart_amount -= formatter_money($request->amount);
        $transfer->charge = $charge;
        $transfer->type = 1;
        $transfer->bank_type = 2;
        $transfer->after_charge = $afterCharge;
        $transfer->final_amount = $afterCharge;
        $transfer->status = 2;
        $transfer->save();


        $user->balance = $user->balance - $request->amount;
        $user->update();


        Trx::create([
            'user_id' => $transfer->user_id,
            'receiver_id' => $receiver,
            'amount' => $transfer->amount,
            'post_balance' => $user->balance,
            'charge' => $transfer->charge,
            'trx_type' => '-',
            'remark' => 'send-money',
            'details' => 'transfer to ' . $transfer->receiver->name,
            'trx' => $transfer->trx,
            'type' => 1
        ]);
        $data['page_title'] = "Success send money";
        $data['username'] = $request->username;
        $data['amount'] = $transfer->final_amount;


        return view('user.own_bank.send_money_success', $data);
    }
    session(['form_submitted' => true]);
    }



    public function account()
    {
        $primary_bank_id = Bank::whereStatus(1)->where('primary',1)->pluck('id')->first();
        $data['bankData'] = Bank::whereStatus(1)->where('primary',0)->get();
        $data['branches'] = Branch::whereStatus(1)->get();
        $data['card_types'] = CardType::whereStatus(1)->get();
        $data['cards'] = Card::where('user_id',auth()->user()->id)->with(['user','cardType'])->get();

        $data['accounts'] = Account::where('user_id',auth()->user()->id)->whereNot('bank_id', $primary_bank_id)->with(['bank'])->get();
        $data['primary_bank_account'] = Account::where('user_id',auth()->user()->id)->where('bank_id', $primary_bank_id)->with(['bank'])->first();

        $data['page_title'] = "Bank Account";

        return view('user.others_bank.account', $data);
    }

    public function destroy($id)
    {
        $data = Account::find($id);
        if (!$data) {
            return redirect()->back()->with('success', ' Deleted successfully');
        }
        $data->delete();
        return redirect()->back()->with('success', ' Deleted successfully');
    }

    public function cardDestroy($id)
    {
        $data = Card::find($id);
        if (!$data) {
            return redirect()->back()->with('success', ' Deleted successfully');
        }
        $data->delete();
        return redirect()->back()->with('success', ' Deleted successfully');
    }

    public function cardStore(Request $request)
    {
        $validatedData = $request->validate([
            'card_type_id' => 'required|exists:card_types,id',
            'options' => 'required|integer|min:0|max:2',
            'card_number' => 'required|string|min:12|max:30',
            'expiry_date' => 'required|date',
            'cvv' => 'required|string|min:3|max:10',
            'card_holder' => 'required|string|max:255',

        ]);

        $exists = Card::where('user_id',auth()->user()->id)->where('card_type_id',$validatedData['card_type_id'])->where('status',0)->first();

        if ($exists) {
            return back()->withErrors( 'Previous request is still pending');
        } else {
            $user_id = auth()->user()->id;
            $card_type_id = $validatedData['card_type_id'];
            $type = $request->options;

            // $expiry_date = Carbon::createFromFormat('Y-m', $request->expiry_date)->format('m/y');
            $expiry_date =Carbon::createFromFormat('Y-m', $request->input('expiry_date'))->lastOfMonth();

            Card::create([
                'user_id' => $user_id,
                'card_type_id' => $card_type_id,
                'type' => $type,
                'card_number' => $request->card_number,
                'cvv' => $request->cvv,
                'card_holder' => $request->card_holder,
                'expiry_date' => $expiry_date,

            ]);

            return back()->with('success', 'Card Request send successfully');
        }
    }

    public function cardUpdate(Request $request,$id)
    {
        $validatedData = $request->validate([
            'expiry_date' => 'required|date',
            'cvv' => 'required|string|min:3|max:10',
            'card_holder' => 'required|string|max:255',

        ]);
        $expiry_date =Carbon::createFromFormat('Y-m', $request->input('expiry_date'))->lastOfMonth();

        $card = Card::where('user_id',auth()->user()->id)->where('id',$id)->first();
        if ($card) {
            $card->expiry_date = $expiry_date;
            $card->cvv = $request->cvv;
            $card->card_holder = $request->card_holder;
            $card->status = 0;
            $card->save();

                return back()->with('success', 'Card Request send successfully');
        } else {
            return back()->withErrors( 'Invalid request');
        }


    }


    public function accountStore(Request $request)
    {

        $validatedData = $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'branch_id' => 'required|exists:branches,id',
            'account_type' => 'required|integer|min:0|max:2',
            // 'ud.*'         => 'required',

        ]);

        $exists = Account::where('user_id',auth()->user()->id)->where('bank_id',$validatedData['bank_id'])->where('status',0)->first();

        if ($exists) {
            return back()->withErrors( 'Previous request is still pending');
        } else {
            $user_id = auth()->user()->id; // Assuming you have user authentication
            $bank_id = $validatedData['bank_id'];
            $branch_id = $validatedData['branch_id'];
            $account_type = $request->account_type;
            // $user_data = json_encode($request->input('ud')); // Assuming 'user_data' is an array

            Account::create([
                'user_id' => $user_id,
                'bank_id' => $bank_id,
                'branch_id' => $branch_id,
                'account_type' => $account_type,
                'account_number' => getAccount(),
            ]);

            return back()->with('success', 'Account Request send successfully');
        }


    }


    public function sendMoneySingle($slug, $id)
    {

        $data['account'] = Account::where('id', $id)->where('user_id',auth()->user()->id)->whereStatus(1)->first();

        if ($data['account'] != null) {
            $data['page_title'] = 'Send Money Via ' . $data['account']->bank->name;

            return view('user.others_bank.send_money', $data);
        }
        return redirect()->route('user.account')->withErrors('Invalid Request');

    }

    public function sendMoneyConfirm(Request $request,$slug, $id)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|gt:0',
        ]);

        if (auth()->user()->balance < $request->amount) {
            return back()->withErrors('Insufficient balance');
        }

        $data['account'] = Account::where('id', $id)->where('user_id',auth()->user()->id)->whereStatus(1)->first();

        if ($data['account'] != null) {
            $data['page_title'] = 'Confirm Send Money Via ' . $data['account']->bank->name;

            $charge = $data['account']->bank->fixed_charge + ($request->amount * $data['account']->bank->percent_charge / 100);
            $afterCharge = $request->amount - $charge;

            $data['amount'] = $request->amount;
            $data['charge'] = $charge;
            $data['after_charge'] = $afterCharge ;

            return view('user.others_bank.send_money_confirm', $data);
        }
        return redirect()->route('user.account')->withErrors('Invalid Request');

    }


    public function sendMoneySubmit(Request $request, $id)
    {

        $this->validate($request, [
            'amount' => 'required|numeric|gt:0'
        ]);

        $account = Account::where('id', $id)->where('user_id',auth()->user()->id)->whereStatus(1)->first();

        if ($account != null) {

            if ($request->amount < $account->bank->minimum_limit) {
                return redirect()->route('user.account')->withErrors('Your Requested Amount is Smaller Than Minimum Amount.');
            }


            if ($request->amount > $account->bank->maximum_limit) {
                return redirect()->route('user.account')->withErrors( 'Your Requested Amount is Larger Than Maximum Amount.');
            }

            $user = User::find(auth()->id());

            if (formatter_money($request->amount) > $user->balance) {
                return redirect()->route('user.account')->withErrors( 'Your Request Amount is Larger Then Your Current Balance.');
            }

            $charge = $account->bank->fixed_charge + ($request->amount * $account->bank->percent_charge / 100);
            $afterCharge = $request->amount - $charge;

            $transfer = new Transfer();
            $transfer->bank_id = $account->bank_id;
            $transfer->user_id = $user->id;
            $transfer->trx = getTrx();
            $transfer->amount = formatter_money($request->amount);
            $transfer->chart_amount -= formatter_money($request->amount);
            $transfer->charge = $charge;
            $transfer->after_charge = $afterCharge;
            $transfer->final_amount = $afterCharge;
            $transfer->detail = $account->user_data;
            $transfer->status = 2;
            $transfer->save();


            $user->balance = $user->balance - $request->amount;
            $user->update();


            Trx::create([
                'user_id' => $transfer->user_id,
                'amount' => $transfer->amount,
                'post_balance' => $user->balance,
                'charge' => $transfer->charge,
                'trx_type' => '-',
                'remark' => 'send-money',
                'details' => 'transfer Via ' . $transfer->bank->name,
                'detail' => $transfer->detail ? json_encode($transfer->detail) : json_encode([]),
                'trx' => $transfer->trx,
                'type' => 2
            ]);

            $data['page_title'] = "Success Send Money";
            $data['amount'] = $transfer->amount;
            $data['bank_name'] = $transfer->bank->name;

            return view('user.others_bank.send_money_success', $data);
        }
        return redirect()->route('user.account')->withErrors('Invalid Request');

    }


    public function transections()
    {
        $page_title = 'Transactions';
        $logs = Transfer::where('user_id', Auth::id())->with(['receiver','bank'])->orderBy('id', 'desc')->paginate(config('constants.table.default'));

        return view('user.transactions', compact('page_title', 'logs'));
    }

    public function notification()
    {
        $page_title = 'Notifications';
        $notification = Trx::where('user_id', auth()->user()->id)
        ->where(function ($query) {
            $query->where('remark', 'admin_added')
                  ->orWhere('remark', 'admin_subtract');
        })->latest()->get();
        return view('user.notifications', compact('page_title','notification'));
    }

    public function contact()
    {
        $page_title = 'Contact us';

        return view('user.contact', compact('page_title'));
    }


}

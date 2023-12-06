<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Lib\GoogleAuthenticator;
use App\Rules\FileTypeValidate;
use App\Models\Setting;
use App\Models\Trx;
use App\Models\User;
use App\Models\Transfer;
use App\Models\Bank;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;

class UserController extends Controller
{

    public function profile()
    {
        $page_title = 'Profile';
        return view('users.profile.index', compact('page_title'));
    }
    public function profileEdit()
    {
        $page_title = 'Profile Edit';
        return view('users.profile.profile_edit', compact('page_title'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|max:160',
            'email' => 'required',
            'phone' => 'required|max:20',
            'address' => 'nullable|max:160',
            'city' => 'nullable|max:160',
            'state' => 'nullable|max:160',
            'zip' => 'nullable|max:160',
            'country' => 'nullable|max:160',
            'avatar' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ]);

        $filename = auth()->user()->avatar;
        if ($request->hasFile('avatar')) {
            try {
                $path = config('constants.user.profile.path');
                $size = config('constants.user.profile.size');
                $filename = upload_image($request->avatar, $path, $size, $filename);
            } catch (\Exception $exp) {
                // $notify[] = ['success', 'Image could not be uploaded'];
                return back()->withErrors( 'Image could not be uploaded');
            }
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' => $filename,
            'address' => [
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
            ]
        ]);
        // $notify[] = ['success', 'Your profile has been updated'];
        return back()->with('success', 'Your profile has been updated');
    }

    public function changePass()
    {
        $page_title = 'Password Change';
        return view('users.profile.password', compact('page_title'));
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





    public function transactions()
    {
        $page_title = 'Transactions';
        $logs = auth()->user()->transactions()->orderBy('id', 'desc')->paginate(config('constants.table.default'));
        return view('users.transactions', compact('page_title', 'logs'));
    }

    public function transactionsDetails($trx, $id)
    {
        $data['page_title'] = 'Transactions Details';
        $data['log'] = Trx::where('user_id', auth()->id())->where('id', $id)->where('trx', $trx)->firstOrFail();
        return view('users.transactions_single', $data);
    }

    public function PendingRequest()
    {
        $page_title = 'Pending Requests';
        $requests = Transfer::where('status', 2)->where('type', 0)->where('receiver_id', auth()->user()->id)->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No request is pending';
        return view('users.request.pending', compact('page_title', 'requests', 'empty_message'));
    }


    public function requestApprove(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $user = auth()->user();

        $transfer = Transfer::where('id',$request->id)->where('status',2)->firstOrFail();
        if ($user->balance < $transfer->final_amount) {
            return back()->withErrors( 'Insufficient Balance');

        }
        $transfer->status = 1;
        $transfer->save();


        $user->balance -= formatter_money($transfer->final_amount);
        $user->save();

        $sender = User::find($transfer->user_id);
        $sender->balance += formatter_money($transfer->final_amount);
        $sender->save();

        return redirect()->route('user.ownbank.pending.request')->with('success', 'Request Marked  as Approved.');
    }

    public function requestReject(Request $request)
    {
        $general = Setting::first();
        $request->validate(['id' => 'required|integer']);
        $transfer = Transfer::where('id',$request->id)->where('status',2)->firstOrFail();
        $transfer->status = 3;
        $transfer->save();

        return redirect()->route('user.ownbank.pending.request')->with('success', 'Request has been rejected.');
    }

    public function requestMoneyOwnBank()
    {
        $data['page_title'] = "Request Money";
        return view('users.own_bank.request_money', $data);
    }
    public function requestMoneySubmitOwnBank(Request $request)
    {

        $this->validate($request, [
            'username' => 'required|string|min:6|max:50',
            'amount' => 'required|numeric|gt:0',
        ]);
        $username = User::where('username',$request->username)->pluck('id')->first();
            if ($username) {
                $receiver = $username;
            } else {
                return back()->withErrors('Please input Valid Username');

            }

        $user = auth()->user();


        $exists = Transfer::where('user_id', $user->id)->where('receiver_id', $username)->where('type', 0)->where('status', 2)->exists();

        if ($exists) {
            return back()->withErrors('You cannot send request again your previous request is still pending');
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
            return back()->with('success','Request send Successfully');
        }
        if ($request->who == 1) {

            $charge = $genaral->fixed_charge + ($request->amount * $genaral->percent_charge / 100);
            $afterCharge = $request->amount - $charge;

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

            return back()->with('success','Request send Successfully');
        }

    }

    public function sendMoneyOwnBank()
    {
        $data['page_title'] = "Send Money";
        return view('users.own_bank.send_money', $data);
    }
    public function sendMoneySubmitOwnBank(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:6|max:50',
            'amount' => 'required|numeric|gt:0',
        ]);
        $username = User::where('username',$request->username)->pluck('id')->first();
            if ($username) {
                $receiver = $username;
            } else {
                return back()->withErrors('Please input Valid Username');

            }

        $user = auth()->user();

        if ($user->balance < $request->amount) {
            return back()->withErrors('Insufficient balance');
        }

        $genaral = Setting::first();

        $charge = $genaral->fixed_charge + ($request->amount * $genaral->percent_charge / 100);
        $afterCharge = $request->amount - $charge;


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
        return back()->with('success','Send Money Successfully');
    }


    public function sendMoney()
    {
        $data['banks'] = Bank::whereStatus(1)->get();
        $data['page_title'] = "Others Bank";
        return view('users.others_bank.send_money', $data);
    }


    public function sendMoneySingle($slug, $id)
    {

        $data['bank'] = Bank::where('id', $id)->whereStatus(1)->first();
        if ($data['bank'] != null) {
            $data['page_title'] = 'Send Money Via ' . $data['bank']->name;
            return view('users.others_bank.single', $data);
        }
        return back()->withErrors('Invalid Request');

    }


    public function sendMoneySubmit(Request $request, $id)
    {



            $general = Setting::first();

            $bank = Bank::where('id', $id)->where('status', 1)->firstOrFail();

        $this->validate($request, [
            'amount' => 'required|numeric|gt:0'
        ]);





        if ($request->amount < $bank->minimum_limit) {
            // $notify[] = ['error', 'Your Requested Amount is Smaller Than Minimum Amount.'];
            return back()->withErrors('Your Requested Amount is Smaller Than Minimum Amount.');
        }


        if ($request->amount > $bank->maximum_limit) {
            // $notify[] = ['error', 'Your Requested Amount is Larger Than Maximum Amount.'];
            return back()->withErrors( 'Your Requested Amount is Larger Than Maximum Amount.');
        }

        $user = User::find(auth()->id());

        if (formatter_money($request->amount) > $user->balance) {
            // $notify[] = ['error', 'Your Request Amount is Larger Then Your Current Balance.'];
            return back()->withErrors( 'Your Request Amount is Larger Then Your Current Balance.');
        }

        $charge = $bank->fixed_charge + ($request->amount * $bank->percent_charge / 100);
        $afterCharge = $request->amount - $charge;


        $transfer = new Transfer();
        $transfer->bank_id = $bank->id;
        $transfer->user_id = $user->id;
        $transfer->trx = getTrx();
        $transfer->amount = formatter_money($request->amount);
        $transfer->chart_amount -= formatter_money($request->amount);
        $transfer->charge = $charge;
        $transfer->after_charge = $afterCharge;
        $transfer->final_amount = $afterCharge;
        $transfer->detail = $request->ud;
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


        return redirect()->route('user.sendmoney')->with('success', 'Send Money Successfully');
    }

    public function withdrawHistory()
    {
        $data['page_title'] = "Withdraw Log";
        $data['withdraws'] = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->latest()->paginate(config('constants.table.default'));
        return view('users.withdraw.log', $data);
    }

    public function withdrawDetails($trx, $id)
    {
        $data['page_title'] = "Withdraw Log";
        $data['log'] = Withdrawal::where('id', $id)->where('user_id', auth()->id())->where('trx', $trx)->where('status', '!=', 0)->with('method')->firstOrFail();
        return view('users.withdraw.withdraw_details', $data);
    }


}

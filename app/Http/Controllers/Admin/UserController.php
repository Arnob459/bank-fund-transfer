<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trx;
use App\Models\UserLogin;
use App\Models\Setting;
use App\Models\Admin;



use Illuminate\Support\Facades\Validator;





class UserController extends Controller
{
    //
    public function Index(){
        $data['page_title'] = 'All Users';
        $data['users'] = User::latest()->paginate(15);
        return view('admin.users.all_users',$data);
    }

    public function activeUsers(){
        $data['page_title'] = 'Active Users';
        $data['users'] = User::where('kyc_verify', 1)->where('email_verify', 1)->where('sms_verify', 1)->where('status', 1)->orderBy('id','desc')->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function pendingUsers(){
        $data['page_title'] = 'Pending Users';
        $data['users'] = User::where('status', 2)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function blockedUsers(){
        $data['page_title'] = 'Blocked Users';
        $data['users'] = User::where('status', 0)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function emailUnverifiedUsers(){
        $data['page_title'] = 'Email Unverified Users';
        $data['users'] = User::where('email_verify', 0)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function smsUnverifiedUsers(){
        $data['page_title'] = 'Sms Unverified Users';
        $data['users'] = User::where('sms_verify', 0)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function kycUnverifiedUsers(){
        $data['page_title'] = 'Kyc Unverified Users';
        $data['users'] = User::where('kyc_verify', 0)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function kycVerifiedUsers(){
        $data['page_title'] = 'Kyc Verified Users';
        $data['users'] = User::where('kyc_verify', 1)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }


    public function userEdit($id){

        $data['user'] = User::findOrfail($id);
        $data['page_title'] = 'USER: ' .$data['user']->username;
        $data['request_amount'] = Trx::where('user_id', $id)->where('remark', 'request')->sum('amount');
        $data['send_amount'] = Trx::where('user_id', $id)->where('remark', 'send')->sum('amount');
        $data['total_trx'] = Trx::where('user_id', $id)->count();

        return view('admin.users.profile',$data);
    }

    public function userUpdate(Request $request ,$id){

        $user = User::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|alpha_num|min:6|max:50|unique:users,username,'.$user->id,
            'phone' => 'nullable|string|max:150|unique:users,phone,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'address' => 'nullable|string|max:190',
            'status' => 'required|integer|string|min:0|max:2',
            'email_verify' => 'required|integer|string|min:0|max:2',
            'sms_verify' => 'required|integer|string|min:0|max:2',
            'kyc_verify' => 'required|integer|string|min:0|max:2',
            'city' => 'nullable|string|max:190',
            'zip' => 'nullable|string|max:190',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'email_verify' => $request->email_verify,
            'sms_verify' => $request->sms_verify,
            'kyc_verify' => $request->kyc_verify,
            'address' => [
                'address' => $request->address,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'zip' => $request->zip,
            ]
        ]);


        return back()->with('success', " updated successfully");
    }

    public function kyc($id){

        $data['user'] = User::findOrfail($id);
        $data['page_title'] = 'USER: ' .$data['user']->username;

        return view('admin.users.kyc',$data);
    }

    public function kycUpdate(Request $request ,$id){

        $user = User::findOrFail($id);


        $request->validate([
            'nid' => 'nullable|image|mimes:jpeg,png,jpg|max:2024',
            'passport' => 'nullable|image|mimes:jpeg,png,jpg|max:2024',
        ]);

        $filename =  $user->nid;
        $filename2 =  $user->passport;



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

        $user->update([
            'nid' => $filename,
            'passport' => $filename2,
            'kyc_verify' => 1,
        ]);

        return back()->with('success', " Approved successfully");
    }

    public function kycReject(Request $request ,$id){

        $user = User::findOrFail($id);
        $user->update([
            'kyc_verify' => 2,
        ]);

        return back()->with('success', " Rejected successfully");
    }


    public function addBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);
        $user = User::findOrFail($id);
        $amount = formatter_money($request->amount);
        $general = Setting::first();

        $trx = getTrx();

        $user->balance = $user->balance + $amount;

            Trx::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'post_balance' => $user->balance,
                'charge' => 0,
                'trx_type' => '+',
                'type' => '1',
                'remark' => 'admin_added',
                'details' => 'Added Balance Via Admin',
                'trx' => $trx
            ]);

            $user->save();
            return back()->with('success', $general->cur_sym . $amount . ' has been added to ' . $user->username . ' balance');

    }



    public function subBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);
        $user = User::findOrFail($id);
        $amount = formatter_money($request->amount);
        $general = Setting::first();

        $trx = getTrx();

        if ($amount > $user->balance) {
            return back()->with('success', " $user->username  has insufficient balance.");

        }
        $user->balance = $user->balance - $amount;

        Trx::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'post_balance' => $user->balance,
            'charge' => 0,
            'trx_type' => '-',
            'type' => '1',
            'remark' => 'admin_subtract',
            'details' => 'Added Balance Via Admin',
            'trx' => $trx
        ]);

            $user->save();
            return back()->with('success', $general->cur_sym . $amount . ' has been subtracted to ' . $user->username . ' balance');

    }
}

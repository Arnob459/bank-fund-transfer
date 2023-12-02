<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trx;
use App\Models\UserLogin;
use App\Models\Setting;
use App\Models\Admin;
use App\Models\Invest;
use App\Models\Deposit;
use App\Models\Withdrawal;



use Illuminate\Support\Facades\Validator;





class UserController extends Controller
{
    //
    public function Index(){
        $data['page_title'] = 'All Users';
        $data['users'] = User::with('parent')->latest()->paginate(15);
        return view('admin.users.all_users',$data);
    }

    public function activeUsers(){
        $data['page_title'] = 'Active Users';
        $data['users'] = User::with('parent')->where('email_verify', 1)->where('sms_verify', 1)->where('status', 1)->orderBy('id','desc')->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function pendingUsers(){
        $data['page_title'] = 'Pending Users';
        $data['users'] = User::with('parent')->where('status', 2)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function blockedUsers(){
        $data['page_title'] = 'Blocked Users';
        $data['users'] = User::with('parent')->where('status', 0)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function emailUnverifiedUsers(){
        $data['page_title'] = 'Email Unverified Users';
        $data['users'] = User::with('parent')->where('email_verify', 0)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function smsUnverifiedUsers(){
        $data['page_title'] = 'Sms Unverified Users';
        $data['users'] = User::with('parent')->where('sms_verify', 0)->latest()->paginate(15);


        return view('admin.users.all_users',$data);
    }

    public function userEdit($id){

        $data['user'] = User::findOrfail($id);
        $data['page_title'] = 'USER: ' .$data['user']->username;
        $data['ref'] = User::find( $data['user']->refferal);
        $data['total_invest'] = Invest::where('user_id', $id)->sum('amount');
        $data['total_deposit'] = Deposit::where('user_id', $id)->where('status', 1)->sum('amount');
        $data['total_Withdrawal'] = Withdrawal::where('user_id', $id)->where('status', 1)->sum('amount');


        $data['total_interest_return'] = Trx::where('user_id', $id)->where('remark', 'interest')->sum('amount');
        $data['ref_com'] = Trx::where('user_id', $id)->where('remark', 'ref_com')->sum('amount');
        $data['total_trx'] = Trx::where('user_id', $id)->count();

        $data['ref_by'] = User::where('refferal', $data['user']->id)->first(['username', 'id']);

        return view('admin.users.profile',$data);
    }

    public function userUpdate(Request $request ,$id){

        $user = User::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|integer|digits:8|unique:users,username,'.$user->id,
            'phone' => 'nullable|string|max:150|unique:users,phone,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'address' => 'nullable|string|max:190',
            'status' => 'required|integer|string|min:0|max:2',
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
            'ts' => $request->two_fa_status,
            'tv' => $request->two_fa_verify,
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

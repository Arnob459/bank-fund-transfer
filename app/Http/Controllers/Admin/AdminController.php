<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Trx;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Account;
use App\Models\Transfer;


class AdminController extends Controller
{



      public function autoLogin($id)
     {
         $user = User::findOrFail($id);
         Auth::login($user);
         return redirect()->route('user.home');
     }


    public function dashboard()
    {
        $data['page_title'] = 'Dashboard';

        $data['page_title'] = 'Dashboard';
        $data['total_user'] = User::count();
        $data['active_user'] = User::where('status', 1)->where('email_verify', 1)->where('sms_verify', 1)->count();
        $data['pending_user'] = User::where('status', 2)->count();
        $data['block_user'] = User::where('status', 0)->count();
        $data['email_verify'] = User::where('email_verify', 1)->count();
        $data['email_unverify'] = User::where('email_verify', 0)->count();
        $data['sms_verify'] = User::where('sms_verify', 1)->count();
        $data['sms_unverify'] = User::where('sms_verify', 0)->count();
        $data['kyc_verify'] = User::where('kyc_verify', 1)->count();
        $data['kyc_unverify'] = User::where('kyc_verify', 0)->count();
        $data['balance'] = User::sum('balance') + 0;

        $data['total_accounts'] = Account::count();
        $data['pending_accounts'] = Account::where('status', 0)->count();
        $data['active_accounts'] = Account::where('status', 1)->count();
        $data['reject_accounts'] = Account::where('status', 2)->count();

        $data['total_requests'] = Transfer::where('type', 0)->count();
        $data['pending_requests'] = Transfer::where('type', 0)->where('status', 2)->count();
        $data['active_requests'] = Transfer::where('type', 0)->where('status', 1)->count();
        $data['reject_requests'] = Transfer::where('type', 0)->where('status', 3)->count();

        $data['total_send_money'] = Transfer::where('type', 1)->count();
        $data['pending_send_money'] = Transfer::where('type', 1)->where('status', 2)->count();
        $data['active_send_money'] = Transfer::where('type', 1)->where('status', 1)->count();
        $data['reject_send_money'] = Transfer::where('type', 1)->where('status', 3)->count();





        return view('admin.dashboard', $data);
    }





    public function profile()
    {
        $page_title = 'Profile';
        $admin = Auth::guard('admin')->user();
        return view('admin.admin_profile.index', compact('page_title', 'admin'));
    }

    public function passwordChange()
    {
        $page_title = 'Change Password';
        $admin = Auth::guard('admin')->user();
        return view('admin.admin_profile.password', compact('page_title', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);
        $user = Auth::guard('admin')->user();
        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = upload_image($request->image, config('constants.admin.profile.path'), config('contants.admin.profile.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('success',' cant upload image');

            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return back()->with('success',' Updated Successfully');

    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',

        ]);
        $user = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['Password Do not match !!']);
        }

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', 'Password Changed Successfully');
    }
    public function accounts()
    {
        $page_title = 'Pending Accounts';
        $accounts = Account::with(['user','bank'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No accounts is pending';
        return view('admin.account.accounts', compact('page_title', 'accounts', 'empty_message'));
    }

    public function accountActivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $bank = Account::where('id', $request->id)->first();

        $bank->update(['status' => 1]);

        return back()->with('success', ' Account has been activated.');
    }

    public function accountDectivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $bank = Account::where('id', $request->id)->first();

        $bank->update(['status' => 2]);

        return back()->with('success', 'Account has been deactivated.');
    }

}

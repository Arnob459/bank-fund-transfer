<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Deposit;
use App\Models\Invest;
use App\Models\Trx;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Withdrawal;

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

}


function month()
{
    return [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];
}


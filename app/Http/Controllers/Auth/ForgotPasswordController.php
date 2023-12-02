<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function from()
    {
        $data['page_title'] = "Forgot Password";
        return view('auth.passwords.email', $data);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        PasswordReset::where('email', $user->email)->delete();
        $code = verification_code(6);
        PasswordReset::create([
            'email' => $user->email,
            'token' => $code,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        $userAgent = getIpInfo();
        send_email($user, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => $userAgent['os_platform'],
            'browser' => $userAgent['browser'],
            'ip' => $userAgent['ip'],
            'time' => $userAgent['time']
        ]);

        $page_title = 'Account Recovery';
        $email = $user->email;
        return view('auth.passwords.code_verify', compact('page_title', 'email'))->with('success', 'Password reset email sent successfully');
    }

    public function verifyCode(Request $request)
    {

        $request->validate(['code' => 'required', 'email' => 'required']);
        if (PasswordReset::where('token', $request->code)->where('email', $request->email)->count() != 1) {
            // $notify[] = [];
            return redirect()->route('user.password.request')->with('error', 'Invalid token');
        }

        session()->flash('fpass_email', $request->email);
        return redirect()->route('user.password.reset', $request->code)->with('success', 'You can change your password.');
    }
}

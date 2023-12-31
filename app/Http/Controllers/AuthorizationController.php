<?php

namespace App\Http\Controllers;

use App\Lib\GoogleAuthenticator;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthorizationController extends Controller
{
    public function checkValidCode($user, $code, $add_min = 10000)
    {
        if (!$code) return false;
        if (!$user->ver_code_send_at) return false;
        if ($user->ver_code_send_at->addMinutes($add_min) < Carbon::now()) return false;
        if ($user->ver_code !== $code) return false;
        return true;
    }

    public function authorizeForm()
    {
        $view = 'user.authorize';
        if (auth()->check()) {
            $user = auth()->user();
            if (!$user->status) {
                $page_title = 'Your Account has been blocked';
                return view($view, compact('user', 'page_title'));
            } elseif (!$user->email_verify) {
                if (!$this->checkValidCode($user, $user->ver_code)) {
                    $user->ver_code = verification_code(6);
                    $user->ver_code_send_at = Carbon::now();
                    $user->save();
                    send_email($user, 'EVER_CODE', [
                        'code' => $user->ver_code
                    ]);
                }
                $page_title = 'Email verification form';
                return view($view, compact('user', 'page_title'));
            } elseif (!$user->sms_verify) {
                if (!$this->checkValidCode($user, $user->ver_code)) {
                    $user->ver_code = verification_code(6);
                    $user->ver_code_send_at = Carbon::now();
                    $user->save();
                    send_sms($user, 'SVER_CODE', [
                        'code' => $user->ver_code
                    ]);
                }
                $page_title = 'SMS verification form';
                return view($view, compact('user', 'page_title'));
            } elseif (!$user->tv) {
                $page_title = 'Google Authenticator';
                return view($view, compact('user', 'page_title'));
            }
        }
        return redirect()->route('login');
    }

    public function sendVerifyCode(Request $request)
    {
        $user = Auth::user();
        if ($this->checkValidCode($user, $user->ver_code, 2)) {
            $target_time = $user->ver_code_send_at->addMinutes(2)->timestamp;
            $delay = $target_time - time();
            throw ValidationException::withMessages(['resend' => 'Please Try after ' . $delay . ' Seconds']);
        }
        if (!$this->checkValidCode($user, $user->ver_code)) {
            $user->ver_code = verification_code(6);
            $user->ver_code_send_at = Carbon::now();
            $user->save();
        } else {
            $user->ver_code = $user->ver_code;
            $user->ver_code_send_at = Carbon::now();
            $user->save();
        }

        if ($request->type === 'email') {
            send_email($user, 'EVER_CODE', [
                'code' => $user->ver_code
            ]);
            return back()->with('success', 'Email verification code sent successfully');
        } elseif ($request->type === 'phone') {
            send_sms($user, 'SVER_CODE', [
                'code' => $user->ver_code
            ]);
            return back()->with('success', 'SMS verification code sent successfully');
        } else {
            throw ValidationException::withMessages(['resend' => 'Sending Failed']);
        }
    }
    public function emailVerification(Request $request)
    {

        $request->validate([
            'email_verified_code' => 'required',
        ], [
            'email_verified_code.required' => 'Email verification code is required',
        ]);

        $user = Auth::user();
        if ($this->checkValidCode($user, $request->email_verified_code)) {
            $user->email_verify = 1;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            return redirect()->intended(route('user.home'));
        }
        throw ValidationException::withMessages(['email_verified_code' => 'Verification code didn\'t match!']);
    }

    public function smsVerification(Request $request)
    {
        $request->validate([
            'sms_verified_code' => 'required',
        ], [
            'sms_verified_code.required' => 'SMS verification code is required',
        ]);
        $user = Auth::user();
        if ($this->checkValidCode($user, $request->sms_verified_code)) {
            $user->sms_verify = 1;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            return redirect()->intended(route('user.home'));
        }
        throw ValidationException::withMessages(['sms_verified_code' => 'Verification code didn\'t match!']);
    }

    public function g2faVerification(Request $request)
    {
        $user = auth()->user();

        $this->validate(
            $request,
            [
                'code' => 'required',
            ]
        );
        $ga = new GoogleAuthenticator();

        $secret = $user->tsc;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;
        if ($oneCode == $userCode) {
            $user->tv = 1;
            $user->save();
            return redirect()->route('user.home');
        } else {
            return back()->withErrors( 'Wrong Verification Code');
        }
    }
}

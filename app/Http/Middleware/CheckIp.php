<?php

namespace App\Http\Middleware;

use Closure;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class CheckIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {



        if (Auth::check()) {
            $user = Auth()->user();
            if ($user->status == 1  && $user->email_verify == 1  && $user->sms_verify == 1  && $user->tv) {
                return $next($request);
            } else {
                if ($user->status != 1)
                {
                    Auth::guard()->logout();
                }

                return redirect()->route('user.authorization');
            }
        }
    }
}

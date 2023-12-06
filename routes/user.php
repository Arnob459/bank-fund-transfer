<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RefController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\SupportTicketController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use Illuminate\Support\Facades\Route;



    Route::name('user.')->group(function() {

        Route::get('user/password/reset', [ForgotPasswordController::class, 'from'])->name('password.request');
        Route::post('user/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::post('user/password/verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify-code');
        Route::get('user/password/reset/{token}', [ResetPasswordController::class, 'showReset'])->name('password.reset');
        Route::post('user/password/reset/now', [ResetPasswordController::class, 'reset'])->name('password.update.now');


        Route::middleware(['auth'])->group(function () {

            Route::get('authorization', [AuthorizationController::class, 'authorizeForm'])->name('authorization');
            Route::get('resend-verify', [AuthorizationController::class, 'sendVerifyCode'])->name('send_verify_code');
            Route::post('verify-email', [AuthorizationController::class, 'emailVerification'])->name('verify_email');
            Route::post('verify-sms', [AuthorizationController::class, 'smsVerification'])->name('verify_sms');
            Route::post('verify-g2fa', [AuthorizationController::class, 'g2faVerification'])->name('go2fa.verify');

            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


            Route::middleware('ckstatus')->group(function () {
                //Your routes here
                //Dashboard
                Route::get('/home', [HomeController::class, 'index'])->name('home');

                //user profile
                Route::get('/profile', [UserController::class, 'profile'])->name('profile');
                Route::get('/profile-edit', [UserController::class, 'profileEdit'])->name('profile.edit');

                Route::get('/change-password', [UserController::class, 'changePass'])->name('change.password');
                Route::put('/password', [UserController::class, 'passwordUpdate'])->name('password.update');
                Route::put('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');


                Route::get('send-money', [UserController::class, 'sendMoney'])->name('sendmoney');
                Route::get('send-money/{slug}/{id}', [UserController::class, 'sendMoneySingle'])->name('sendmoney.single');

                Route::post('/send-money/{id}', [UserController::class, 'sendMoneySubmit'])->name('sendmoney.submit');

                Route::get('/ownbank/send-money', [UserController::class, 'sendMoneyOwnBank'])->name('ownbank.sendmoney');
                Route::post('/ownbank/send-money', [UserController::class, 'sendMoneySubmitOwnBank'])->name('ownbank.sendmoney.submit');

                Route::get('/ownbank/request-money', [UserController::class, 'requestMoneyOwnBank'])->name('ownbank.requestmoney');
                Route::post('/ownbank/request-money', [UserController::class, 'requestMoneySubmitOwnBank'])->name('ownbank.requestmoney.submit');

                Route::get('/own-bank/pending-request', [UserController::class, 'PendingRequest'])->name('ownbank.pending.request');
                Route::post('own-bank/request/approve', [UserController::class, 'requestApprove'] )->name('ownbank.request.approve');
                Route::post('own-bank/tranrequestsfer/reject', [UserController::class, 'requestReject'] )->name('ownbank.request.reject');

                Route::get('/login/history', [UserController::class, 'loginHistory'])->name('login.history');

            });
        });
    });
Auth::routes();

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

                Route::put('/password', [UserController::class, 'passwordUpdate'])->name('password.update');
                Route::put('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');
                Route::put('/contact', [UserController::class, 'contactUpdate'])->name('contact.update');

                Route::put('/avatar', [UserController::class, 'avatarUpdate'])->name('avatar.update');
                Route::put('/kyc-verification', [UserController::class, 'kycUpdate'])->name('kyc.update');

                Route::get('/notifications', [UserController::class, 'notification'])->name('notifications');




                //Account and Card
                Route::get('/account', [UserController::class, 'account'])->name('account');
                Route::post('/account', [UserController::class, 'accountStore'])->name('account.store');
                Route::delete('/account/{id}', [UserController::class, 'destroy'])->name('account.destroy');
                Route::post('/card', [UserController::class, 'cardStore'])->name('card.store');
                Route::delete('/card/{id}', [UserController::class, 'cardDestroy'])->name('card.destroy');



                Route::get('/other-bank/send-money', [UserController::class, 'sendMoney'])->name('sendmoney');
                Route::get('/other-bank/send-money/{slug}/{id}', [UserController::class, 'sendMoneySingle'])->name('sendmoney.single');
                Route::post('/other-bank/send-money-confirm/{slug}/{id}', [UserController::class, 'sendMoneyConfirm'])->name('sendmoney.confirm');


                Route::post('/other-bank/send-money/{id}', [UserController::class, 'sendMoneySubmit'])->name('sendmoney.submit');
                //send/request
                Route::get('/send-money', [UserController::class, 'sendMoneyOwnBank'])->name('ownbank.sendmoney');
                Route::get('/send-money-confirm', [UserController::class, 'sendMoneyOwnBankC'])->name('ownbank.sendmoneyc');

                Route::post('/send-money-confirm', [UserController::class, 'sendMoneyConfirmOwnBank'])->name('ownbank.sendmoney.confirm');

                Route::post('/send-money', [UserController::class, 'sendMoneySubmitOwnBank'])->name('ownbank.sendmoney.submit');



                Route::get('/request-money', [UserController::class, 'requestMoneyOwnBank'])->name('ownbank.requestmoney');
                Route::post('/request-money-confirm', [UserController::class, 'requestMoneyConfirmOwnBank'])->name('ownbank.requestmoney.Confirm');

                Route::post('/request-money', [UserController::class, 'requestMoneySubmitOwnBank'])->name('ownbank.requestmoney.submit');

                //Transections
                Route::get('/transections', [UserController::class, 'transections'])->name('transections');


                Route::get('/requests', [UserController::class, 'PendingRequest'])->name('requests');
                Route::post('/request/approve', [UserController::class, 'requestApprove'] )->name('request.approve');
                Route::post('/request/reject', [UserController::class, 'requestReject'] )->name('request.reject');

                Route::get('/login/history', [UserController::class, 'loginHistory'])->name('login.history');

            });
        });
    });
Auth::routes();

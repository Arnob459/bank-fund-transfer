<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckUsernameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Mail;
use App\Mail\MyCustomEmail;

Route::get('/send-email', function () {
    Mail::to('marketiah.info@gmail.com')->send(new MyCustomEmail());
    return "Email sent successfully!";
});

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('index');

Route::get('checkusername', [CheckUsernameController::class, 'Checkusername'])->name('checkusername');

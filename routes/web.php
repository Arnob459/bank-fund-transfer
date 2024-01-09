<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckUsernameController;
use App\Http\Controllers\FrontendController;

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
Route::get('about-us', [FrontendController::class, 'aboutus'])->name('aboutus');
Route::get('blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('terms', [FrontendController::class, 'terms'])->name('terms');
Route::get('privacy', [FrontendController::class, 'privacy'])->name('privacy');



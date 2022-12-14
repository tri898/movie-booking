<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('social-login/{provider}/callback', [SocialLoginController::class,'providerCallback'])
    ->whereIn('provider', ['facebook', 'github']);
Route::get('social-login/{provider}', [SocialLoginController::class,'redirectToProvider'])
    ->whereIn('provider', ['facebook', 'github'])
    ->name('social-login.redirect');

<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\{
    UserManagerController,
    RoleController
};
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

// Private route CMS admin
Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    Route::get('welcome', function () {
        return view('admin.index');
    })->name('admin.welcome.index');
    Route::name('cms.')->group(function () {
        Route::resource('user-manager', UserManagerController::class)->except(['show','destroy']);
        Route::apiResource('roles', RoleController::class);

    });
});

// Public route CMS admin
Route::group(['prefix' => 'admin'], function () {
    Route::name('admin.')->group(function () {
        Route::get('login', [AdminAuthController::class, 'index'])->name('auth.index');
        Route::post('login', [AdminAuthController::class, 'login'])->name('auth.login');
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('auth.logout');
    });
});

Route::get('social-login/{provider}/callback', [SocialLoginController::class, 'providerCallback'])
    ->whereIn('provider', ['facebook', 'github']);
Route::get('social-login/{provider}', [SocialLoginController::class, 'redirectToProvider'])
    ->whereIn('provider', ['facebook', 'github'])
    ->name('social-login.redirect');

<?php

use App\Http\Controllers\Admin\{DeleteEntityController, PermissionController, RoleController, UserManagerController};
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['guest:admin'], 'prefix' => 'admin'], function () {
    Route::get('welcome', function () {
        return view('admin.index');
    })->name('admin.welcome.index');
});
// Private route CMS admin
Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    Route::name('cms.')->group(function () {
        Route::resource('user-manager', UserManagerController::class)->except(['show', 'destroy']);
        Route::apiResource('role', RoleController::class);
        Route::get('permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::put('permission', [PermissionController::class, 'update'])->name('permission.update');
        Route::post('permission', [PermissionController::class, 'syncPermissions'])->name('permission.sync');
        Route::resource('media', MediaController::class)->except(['show','edit','update']);
    });
});
    Route::get('{entity}/delete/{ids}/confirm', [DeleteEntityController::class, 'confirm'])
        ->name('entity.delete.confirm');
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::get('media/{id}', [MediaController::class, 'render'])->name('media.get');


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

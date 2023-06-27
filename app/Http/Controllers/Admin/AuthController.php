<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Render view.
     * @return string
     */
    public function index(): string
    {
        return Auth::guard('admin')->check()
            ? redirect()->route('admin.dashboard.index') : view('admin.login');
    }

    /**
     * Authenticate.
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $rememberMe = $request->has('remember_me');
        $request = $request->validated();
        if (Auth::guard('admin')->attempt($request, $rememberMe)) {
            session()->regenerate();
            return redirect()->route('admin.dashboard.index');
        }
        return back()->withErrors([
            'status' => 'Please check your login information.',
        ])->withInput();
    }

    /**
     * Logout.
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return back();
    }
}

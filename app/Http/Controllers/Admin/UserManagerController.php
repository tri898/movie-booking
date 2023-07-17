<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagerRequest;
use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class UserManagerController extends Controller
{
    /**
     * Render view index.
     *
     * @return string
     */
    public function index(): string
    {
        $admins = Admin::with('roles:name')->latest()->paginate(10);
        return view('admin.user-manager.index')->with([
            'admins' => $admins
        ]);
    }

    /**
     * Render view create.
     *
     * @return string
     */
    public function create(): string
    {
        $roles = Role::all('name');

        return view('admin.user-manager.create')->with([
            'roles' => $roles
        ]);
    }

    /**
     * @param UserManagerRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function store(UserManagerRequest $request)
    {
        $email = Admin::whereEmail($request->email)->first();
        if ($email) {
            return back()->withErrors([
                'status' => 'The email has already been taken.',
            ])->withInput();
        }
        $credentials = $request->only(['email', 'name', 'password', 'status']);
        $admin = Admin::create($credentials);
        $admin->assignRole($request->roles);
        // send mail confirm
        // todo
        return redirect()->route('admin.user-manager.index')->with([
            'status' => 'Create user manager successfully.',
        ]);
    }

}

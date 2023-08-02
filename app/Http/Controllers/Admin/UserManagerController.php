<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagerRequest;
use App\Repositories\Admin\AdminRepositoryInterface;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class UserManagerController extends Controller
{
    /**
     * @var AdminRepositoryInterface
     */
    protected AdminRepositoryInterface $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Render view index.
     *
     * @return View
     */
    public function index(): View
    {
        $admins = $this->adminRepository->getAllWith(['roles:name']);
        return view('admin.user-manager.index')->with([
            'admins' => $admins
        ]);
    }

    /**
     * Render view create.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all('name');
        return view('admin.user-manager.create')->with([
            'roles' => $roles
        ]);
    }

    /**
     * @param UserManagerRequest $request
     * @return RedirectResponse
     */
    public function store(UserManagerRequest $request)
    {
        $email = $this->adminRepository->findByField('email', $request->email);
        if ($email) {
            return back()->withErrors([
                'message' => 'The email has already been taken.',
            ])->withInput();
        }
        $credentials = $request->only(['email', 'name', 'password', 'status']);
        $admin = $this->adminRepository->store($credentials);
        $admin->assignRole($request->roles);
        // send verify email.
        return redirect()->route('admin.user-manager.index')->with([
            'message' => 'Create user manager successfully.',
        ]);
    }

    /**
     * Render view update.
     *
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $admin = $this->adminRepository->findOrFail($id);
        $roles = Role::all('name');
        return view('admin.user-manager.edit')->with([
            'admin' => $admin,
            'roles' => $roles
        ]);
    }

    /**
     * @param UserManagerRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UserManagerRequest $request, $id)
    {
        $admin = $this->adminRepository->findOrFail($id);
        $credentials = $request->only(['name', 'password', 'status']);
        $adminData = $this->adminRepository->update($id, $credentials);
        $admin->syncRoles($request->roles);

        $message = $adminData ? 'Update user manager successfully.' : 'Something wrong';
        return redirect()->route('admin.user-manager.index')->with([
            'message' => $message
        ]);
    }

}

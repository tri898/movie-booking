<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagerRequest;
use App\Repositories\Admin\AdminRepositoryInterface;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Plank\Mediable\Media;
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
        $admins = $this->adminRepository->getWithRoles();
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
     * Store user.
     *
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
        $admin->assignRole($request->get('roles'));
        $admin->syncMedia($request->get('avatar'), 'avatar');

        return redirect()->route('cms.user-manager.index')->with([
            'message' => "Create user ($admin->email) successfully.",
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
        $avatar = $admin->getMedia('avatar')->first();

        return view('admin.user-manager.edit')->with([
            'admin' => $admin,
            'roles' => $roles,
            'avatar' => $avatar
        ]);
    }

    /**
     * Update user.
     *
     * @param UserManagerRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UserManagerRequest $request, $id)
    {
        $admin = $this->adminRepository->findOrFail($id);
        $credentials = $request->only(['name', 'password', 'status']);
        $credentials = array_filter($credentials, function ($value) {
            return $value !== null;
        });
        $adminData = $this->adminRepository->update($id, $credentials);
        $admin->syncRoles($request->get('roles'));
        $admin->syncMedia($request->get('avatar'), 'avatar');

        $message = $adminData ? "Update user ($admin->email) successfully." : 'Something wrong';
        return redirect()->route('cms.user-manager.index')->with([
            'message' => $message
        ]);
    }

}

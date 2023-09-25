<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class PermissionController extends Controller
{
    /**
     * Render view index.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = Role::with('permissions:name')->get(['id', 'name']);
        $permissions = Permission::all('name');
        return view('admin.permission.index')->with([
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update permissions to roles.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        if ($request->has('data')) {
            $data = $request->get('data');
            Role::whereIn('name', array_keys($data))
                ->chunkById(10, function ($roles) use ($data) {
                    foreach ($roles as $role) {
                        $role->syncPermissions(array_values(array_keys($data[$role->name])));
                    }
                });

        }
        return redirect()->route('cms.permissions.index')->with([
            'message' => 'Update permissions successfully.'
        ]);
    }

    /**
     * Sync permission.
     *
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function syncPermissions(): RedirectResponse
    {
        $routes = collect(Route::getRoutes()->getRoutes())
            ->filter(function ($value) {
                return Str::contains($value->getName(), 'cms.');
            });
        foreach ($routes as $route) {
            Permission::findOrCreate($route->getName(), 'admin');
        }
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('cms.permissions.index')->with([
            'message' => 'Sync permissions successfully.'
        ]);
    }


}

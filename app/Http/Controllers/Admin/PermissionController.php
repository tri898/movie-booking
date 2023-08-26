<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
//       $routes = collect(Route::getRoutes()->getRoutes())
//           ->filter(function ($value) {
//           return Str::contains($value->getName(), 'cms.');
//       });
//        foreach ($routes as $route) {
//            Permission::create(['guard_name' => 'admin', 'name' => $route->getName()]);
//       }
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
    public function update(Request $request)
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


}

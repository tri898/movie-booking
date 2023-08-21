<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
//            dump($route->getName());
//       }
        $roles = Role::all();
        return view('admin.role.index')->with([
            'roles' => $roles
        ]);
    }

    /**
     * Store role.
     *
     * @param UserManagerRequest $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:5|max:50|',
        ]);
        if ($validator->fails()) {
            return response()->validator($validator->errors());
        }
        $role = Role::create(['guard_name' => 'admin', 'name' => $request->name]);
        return response()->created($role);
    }

    /**
     * Render role data.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $response = Role::findById($id, 'admin');
        } catch (\Exception $exception) {
            return response()->notFound([], $exception->getMessage());
        }
        return response()->ok($response);
    }

    /**
     * Update role.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $role = Role::findById($id, 'admin');
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:5|max:50|unique:roles,name,' . $role->id,
            ]);
            if ($validator->fails()) {
                return response()->validator($validator->errors());
            }

            $role->updateOrFail(['guard_name' => 'admin', 'name' => $request->name]);
        } catch (\Exception|\Throwable $exception) {
            return response()->internalServerError([$exception]);
        }
        return response()->ok($role);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $role = Role::findById($id, 'admin');
            $role->delete();
        } catch (\Exception $exception) {
            return response()->notFound([], $exception->getMessage());
        }
        return response()->noContentData();
    }

}

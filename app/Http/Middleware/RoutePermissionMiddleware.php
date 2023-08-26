<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoutePermissionMiddleware
{
    public function handle($request, Closure $next, $guard = null, $exceptRole = 'super-admin')
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $roles = is_array($exceptRole)
            ? $exceptRole
            : explode('|', $exceptRole);

        if ($authGuard->user()->hasAnyRole($roles)) {
            return $next($request);
        }
        if ($authGuard->user()->can(Route::current()->getName())) {
            return $next($request);
        }

        throw UnauthorizedException::forPermissions([Route::current()->getName()]);
    }
}

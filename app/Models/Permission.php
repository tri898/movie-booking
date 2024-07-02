<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Permission extends \Spatie\Permission\Models\Permission
{
    public $guard_name = 'admin';

    public static function syncFrom(array $currentPermissions): void
    {
        $permissions = static::getPermissions()->map(function ($permission) {
            return $permission->name;
        });
        $permissionsCreate = collect($currentPermissions)->diff($permissions);
        $permissionsCreate->chunk(20)->each(function ($items) {
            foreach ($items as $item) {
                static::create(['name' => $item]);
            }
        });
        if ($permissions->isNotEmpty()) {
            $permissionsDelete = $permissions->diff($currentPermissions);
            $permissionsDelete->chunk(20)->each(function ($items) {
                foreach ($items as $item) {
                    static::query()->where(['name' => $item])->delete();
                }
            });
        }

    }
}

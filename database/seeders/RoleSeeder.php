<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Role::create(['guard_name' => 'admin', 'name' => 'super-admin']);
        Role::create(['guard_name' => 'admin', 'name' => 'content-editor']);
        Role::create(['guard_name' => 'admin', 'name' => 'customer-care']);
        Role::create(['guard_name' => 'admin', 'name' => 'system-manager']);
    }
}

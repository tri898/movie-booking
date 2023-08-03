<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = DB::table('admins')->where('id', '=', 1)->get();
        if ($superAdmin->isEmpty()) {
            // Reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
           $admin =  Admin::create([
                'name' => ENV('SUPPER_ADMIN_NAME'),
                'email' => ENV('SUPPER_ADMIN_EMAIL'),
                'password' => ENV('SUPPER_ADMIN_PASSWORD'),
                'status' => TRUE,
            ]);
           $admin->assignRole('super-admin');
        }
    }
}

<?php

namespace Database\Seeders;

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
            DB::table('admins')->insert([
                'name' => ENV('SUPPER_ADMIN_NAME'),
                'email' => ENV('SUPPER_ADMIN_EMAIL'),
                'password' => Hash::make(ENV('SUPPER_ADMIN_PASSWORD')),
                'status' => TRUE,
            ]);
        }
    }
}

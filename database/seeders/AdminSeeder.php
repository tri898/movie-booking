<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => ENV('SUPPER_ADMIN_NAME'),
            'email' =>ENV('SUPPER_ADMIN_EMAIL'),
            'password' => Hash::make(ENV('SUPPER_ADMIN_PASSWORD')),
        ]);
    }
}

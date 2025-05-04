<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
               [
                    'name' => 'Super Admin',
                    'email' => 'super-admin@e-civil.com',
                    'contact' => '01 00 00 00 00',
                    'role' => 'super-admin',
                    'password' => Hash::make('Ecivil@2025'),
                    'created_at' => now(),
                ]
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                    'email' => 'admin-ecivil@app.com',
                    'contact' => '01 00 00 00 00',
                    'role' => 'super-admin',
                    'password' => Hash::make('ecivilApp@2025'),
                    'confirmation_token' => null,
                    'created_at' => now(),
                ]
            ]
        );
    }
}

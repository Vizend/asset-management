<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'Admin IT',
                'email' => 'admin@asset.com',
                'phone' => '081111111111',
                'department' => 'IT',
                'status' => 'active',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'role_id' => 2,
                'name' => 'Staff User',
                'email' => 'staff@asset.com',
                'phone' => '082222222222',
                'department' => 'Finance',
                'status' => 'active',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'role_id' => 3,
                'name' => 'Manager User',
                'email' => 'manager@asset.com',
                'phone' => '083333333333',
                'department' => 'Management',
                'status' => 'active',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

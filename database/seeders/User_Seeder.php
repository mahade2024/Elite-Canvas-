<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Owner',
                'email' => 'owner@elitecanvas.com',
                'password' => Hash::make('123'),
                'role' => 1, // 1 = Admin Access
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mahade',
                'email' => 'client@gmail.com',
                'password' => Hash::make('123'),
                'role' => 0, // 0 = Normal User Access
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'User',
                'role' => 'user',
                'password' => bcrypt('123456'),
            ],
            [
                'username' => 'Admin',
                'role' => 'admin',
                'password' => bcrypt('Admin'),
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}

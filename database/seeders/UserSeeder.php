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
                'name' => 'user',
                'username' => 'User',
                'email' => 'user@gmail.com',
                'role' => 'user',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}

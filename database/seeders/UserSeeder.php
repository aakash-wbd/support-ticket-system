<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payloads = [
            [
                'role'     => 'ADMIN',
                'name'     => 'Admin',
                'email'    => 'test@admin.com',
                'password' => Hash::make('123456'),
            ],
            [
                'role'     => 'USER',
                'name'     => 'Test User',
                'email'    => 'test@user.com',
                'password' => Hash::make('123456'),
            ],
            [
                'role'     => 'USER',
                'name'     => 'Test User 2',
                'email'    => 'test2@user.com',
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($payloads as $payload) {
            User::create($payload);
        }
    }
}

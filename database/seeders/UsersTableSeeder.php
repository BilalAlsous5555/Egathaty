<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Donations Manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Cash Officer',
                'email' => 'cash@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'In-Kind Officer',
                'email' => 'inkind@example.com',
                'password' => Hash::make('password123'),
            ],
        ];
        /*
        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
        */
        foreach ($users as $user) {
            User::create($user);
        }
    }
}

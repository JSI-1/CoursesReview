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
        // Create admin user (safe to run multiple times)
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // UNIQUE key
            [
                'name' => 'Ahmed Al-Mansouri',
                'password' => Hash::make('password'),
            ]
        );

        // Create sample students with Arabic names (safe to run multiple times)
        $students = [
            ['name' => 'Mohammed Ali', 'email' => 'mohammed@example.com'],
            ['name' => 'Fatima Hassan', 'email' => 'fatima@example.com'],
            ['name' => 'Omar Ibrahim', 'email' => 'omar@example.com'],
            ['name' => 'Aisha Abdullah', 'email' => 'aisha@example.com'],
            ['name' => 'Khalid Mahmoud', 'email' => 'khalid@example.com'],
            ['name' => 'Layla Ahmed', 'email' => 'layla@example.com'],
            ['name' => 'Youssef Saleh', 'email' => 'youssef@example.com'],
            ['name' => 'Noor Mustafa', 'email' => 'noor@example.com'],
            ['name' => 'Hassan Farid', 'email' => 'hassan@example.com'],
            ['name' => 'Sara Nabil', 'email' => 'sara@example.com'],
        ];

        foreach ($students as $student) {
            User::firstOrCreate(
                ['email' => $student['email']], // UNIQUE key
                [
                    'name' => $student['name'],
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем 10 пользователей
        for ($i = 1; $i <= 10; $i++) {
            User::factory()->create([
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
            ]);
        }
    }
} 
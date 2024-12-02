<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Очистите таблицу перед сидингом
        User::truncate();

        // Создайте статичных пользователей
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Taka',
            'email' => 'root@example.com',
            'phone' => '1234564567',
            'password' => bcrypt('root'),
        ]);

        // Создайте дополнительных пользователей с помощью Faker
        User::factory()->count(10)->create();
    }
}

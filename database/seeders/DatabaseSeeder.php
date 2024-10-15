<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'ilham lutfi',
            'email' => 'ilhamlutfi153@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Category::factory(50000)->create();
    }
}

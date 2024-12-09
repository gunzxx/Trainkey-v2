<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'gunz',
            'email' => 'admin@storease.id',
            'password' => '123',
            'high_point' => '12',
            'count_word' => '12',
        ]);

        \App\Models\User::create([
            'name' => 'user 2',
            'email' => 'admin2@storease.id',
            'password' => '123',
            'high_point' => '12',
            'count_word' => '12',
        ]);

        \App\Models\Chat::create([
            'message' => fake()->name(),
            'user_id' => 1,
        ]);

        \App\Models\Chat::create([
            'message' => fake()->name(),
            'user_id' => 1,
        ]);

        \App\Models\Chat::create([
            'message' => fake()->name(),
            'user_id' => 2,
        ]);

        \App\Models\Chat::create([
            'message' => fake()->name(),
            'user_id' => 1,
        ]);

        \App\Models\User::factory(10)->create();
    }
}

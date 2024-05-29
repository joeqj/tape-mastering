<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Audio;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('test')
        ]);

        $user2 = User::factory()->create([
            'name' => 'Joe QJ',
            'email' => 'joe@email.com',
            'password' => Hash::make('password')
        ]);

        Audio::create([
            'user_id' => $user1->id,
            'title' => 'Everything you do is a balloon'
        ]);

        Audio::create([
            'user_id' => $user2->id,
            'title' => 'Roygbiv'
        ]);
    }
}

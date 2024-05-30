<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Submission;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        Submission::create([
            'user_id' => $user1->id,
            'title' => 'Everything you do is a balloon',
            'comment' => 'Probably my fave song from BoC',
            'status' => 'Pending'
        ]);

        Submission::create([
            'user_id' => $user2->id,
            'title' => 'Roygbiv',
            'comment' => 'Quite a bassey song, hoping to get a bit more emphasis on the high frequencies, do not mind distortion',
            'status' => 'Paid'
        ]);
    }
}

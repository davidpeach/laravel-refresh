<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\CreatableRole;
use App\Models\Album;
use App\Models\Creator;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // seed posts with comments
        //
        // seed artists
        //
        // seed albums and songs and listens
        // and assoc with some artists
        //
        // seed films
        // and assoc with some artists
        //
        // seed books
        // and assoc with some artists


        Post::factory()->times(5)->create();

        $commentUser = User::factory()->create();
        $commentedPost = Post::orderBy('published_at', 'desc')->first();

        Comment::factory()->times(50)->create([
            'post_id' => $commentedPost->id,
            'user_id' => $commentUser->id,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $artists = Creator::factory()->times(5)->create();

        $artists->each(function (Creator $artist) {
            Album::factory()
                ->times(5)
                ->hasAttached($artist, [
                    'role' => CreatableRole::DIRECTOR,
                ])
                ->create();
        });
    }
}

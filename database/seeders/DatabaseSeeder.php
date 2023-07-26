<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\CreatableRole;
use App\Models\Activity;
use App\Models\Album;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Creator;
use App\Models\Image;
use App\Models\Note;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Site Owner',
            'email' => 'admin@example.com',
        ]);

        $commenterA = User::factory()->create([
            'name' => 'Commenter Aye',
            'email' => 'commenter+a@example.com',
        ]);

        $commenterB = User::factory()->create([
            'name' => 'Commenter Bee',
            'email' => 'commenter+b@example.com',
        ]);

        $stored = Storage::disk('public')
            ->putFile(
                UploadedFile::fake()
                    ->image('doesnt-matter.jpg', 300, 200)
                    ->size(100)
            );

        Article::factory()
            ->count(6)
            ->has(
                Comment::factory()
                    ->count(5)
                    ->state(new Sequence(
                        ['user_id' => $commenterA->id],
                        ['user_id' => $commenterB->id],
                    )),
            )
            ->has(
                Image::factory()
                    ->count(2)
                    ->state(['path' => $stored])
            )
            ->create();

        Note::factory()
            ->count(6)
            ->has(
                Comment::factory()
                    ->count(5)
                    ->state(new Sequence(
                        ['user_id' => $commenterA->id],
                        ['user_id' => $commenterB->id],
                    )),
            )
            ->create();

        Photo::factory()
            ->count(6)
            ->has(
                Comment::factory()
                    ->count(5)
                    ->state(new Sequence(
                        ['user_id' => $commenterA->id],
                        ['user_id' => $commenterB->id],
                    )),
            )
            ->has(
                Image::factory()
                    ->count(1)
                    ->state(['path' => $stored])
            )
            ->virtual()
            ->create();

        Activity::all()->each(function (Activity $activity) {
            $tags = Tag::factory()->count(5)->create();
            $activity->tags()->sync($tags->pluck('id'));
        });

        // seed artists
        $creatorSinger = Creator::factory()
            ->hasAttached(
                Album::factory()->count(3),
                ['role' => CreatableRole::PERFORMER],
            )
            ->create([
                'name' => 'A Singer',
            ]);
        //
        // seed albums and songs and listens
        // and assoc with some artists
        //
        // seed films
        // and assoc with some artists
        //
        // seed books
        // and assoc with some artists

        /* User::factory()->create([ */
        /*     'name' => 'Test User', */
        /*     'email' => 'test@example.com', */
        /* ]); */

        /* $artists = Creator::factory()->times(5)->create(); */

        /* $artists->each(function (Creator $artist) { */
        /*     Album::factory() */
        /*         ->times(5) */
        /*         ->hasAttached($artist, [ */
        /*             'role' => CreatableRole::DIRECTOR, */
        /*         ]) */
        /*         ->create(); */
        /* }); */
    }
}

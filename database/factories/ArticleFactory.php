<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'excerpt' => vsprintf('<p>%s</p>', [
                Arr::join($this->faker->paragraphs(2), '</p><p>'),
            ]),
            'slug' => Arr::join($this->faker->words(5), '-'),
            'body' => vsprintf('<p>%s</p>', [
                Arr::join($this->faker->paragraphs(5), '</p><p>'),
            ]),
            'published_at' => $this->faker->dateTimeBetween('-12 years', now()),
        ];
    }
}

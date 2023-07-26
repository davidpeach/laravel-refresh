<?php

namespace Database\Factories;

use App\Enums\PhotoType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => PhotoType::REAL->value,
            'title' => $this->faker->sentence(),
            'excerpt' => vsprintf('<p>%s</p>', [
                Arr::join($this->faker->paragraphs(2), '</p><p>'),
            ]),
            'body' => vsprintf('<p>%s</p>', [
                Arr::join($this->faker->paragraphs(5), '</p><p>'),
            ]),
            'slug' => Arr::join($this->faker->words(5), '-'),
            'published_at' => $this->faker->dateTimeBetween('-12 years', now()),
            'is_live' => true,
        ];
    }

    public function virtual(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => PhotoType::VIRTUAL->value,
            ];
        });
    }
}

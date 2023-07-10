<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => collect($this->faker->paragraphs(1))->map(function ($paragraph) {
                return vsprintf('<p>%s</p>', [$paragraph]);
            })->join(''),
        ];
    }
}

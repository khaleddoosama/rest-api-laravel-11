<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LessonTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
       'lesson_id' => \App\Models\Lesson::inRandomOrder()->first()->id,
       'tag_id' => \App\Models\Tag::inRandomOrder()->first()->id,

        ];
    }
}
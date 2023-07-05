<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake('ar')->firstNameMale() . fake('ar')->lastName(),
            'code' => fake()->rando(),
            'section' => fake()->name(),
            'subject' => fake()->name(),
            'room' => fake()->name(),
            'cover_image_path' => fake()->name(),
            'theme' => fake()->name(),
            'user_id' => fake()->name(),
            'status' => fake()->name(),
        ];
    }
}

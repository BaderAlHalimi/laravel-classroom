<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ghf = Classroom::all()->shuffle()->first();
        return [
            //
            'name' => fake()->word(2,true),
            'classroom_id' => $ghf->id,
            'user_id' => $ghf->user_id,
        ];
    }
}

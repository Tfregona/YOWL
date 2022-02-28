<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class commentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'post_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'content' => $this->faker->paragraph,
            'user_id' => $this ->faker->numberBetween($min = 1, $max = 23),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'title' => $this->faker->word,
            'subcat_id' => $this->faker->numberBetween($min = 1, $max = 24),
            'slug' => $this->faker->word,
            'content' => $this->faker->paragraph,
            'url' => $this->faker->url,
            'user_id' => $this ->faker->numberBetween($min = 1, $max = 23),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}

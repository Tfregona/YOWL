<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
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
            'cat_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'description' => $this->faker->paragraph,
            'image' => $this->faker->word,
            'slug' => $this->faker->word,
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}

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
            // Membuat Post Factory untuk Database seeder Post menggunakan tulisan random
            'title' => $this->faker->sentence(mt_rand(2, 4)),
            'content' => $this->faker->sentence(mt_rand(2, 8))
            //
        ];
    }
}

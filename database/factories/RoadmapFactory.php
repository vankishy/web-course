<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roadmap>
 */
class RoadmapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Menyediakan data palsu untuk kolom Anda
        return [
            'name' => fake()->sentence(3),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
        ];
    }
}
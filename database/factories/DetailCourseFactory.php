<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SubCourse;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailCourse>
 */
class DetailCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // BARU: Tambahkan definisi
            'name' => fake()->words(4, true),
            'type' => fake()->randomElement(['PDF', 'Video']),
            'path' => 'courses/dummy_data/materi.pdf', // Contoh path file
            
            // Ini akan memanggil SubCourseFactory, 
            // yang juga akan memicu CourseFactory.
            'subcourse_id' => SubCourse::factory(),
        ];
    }
}

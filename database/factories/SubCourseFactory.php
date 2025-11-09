<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCourse>
 */
class SubCourseFactory extends Factory
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
            'name' => fake()->sentence(3),
            'image_path' => null, // Sesuai database Anda, ini boleh null
            
            // Ini adalah bagian penting:
            // Jika 'course_id' tidak diberikan saat factory dipanggil,
            // ia akan otomatis membuat Course baru menggunakan CourseFactory Anda.
            'course_id' => Course::factory(),
        ];
    }
}

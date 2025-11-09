<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WatchLater;
use App\Models\User;
use App\Models\DetailCourse;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WatchLater>
 */
class WatchLaterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'detail_course_id' => DetailCourse::factory(),
        ];
    }
}

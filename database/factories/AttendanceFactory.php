<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'check_in_time' => $this->faker->date,
            'check_out_time' => $this->faker->date,
            'date' => $this->faker->date,
            'status' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_name' => $this->faker->name,
            'employee_number' => $this->faker->unique()->numerify('EMP#####'),
            'mobile_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'notes' => $this->faker->sentence,
            'user_id' => User::factory()->create()->id,
        ];
    }
}

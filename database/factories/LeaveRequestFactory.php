<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory()->create()->id,
            'leave_type_id' => LeaveType::factory()->create()->id,
            'from_date' => '2025-02-10',
            'to_date' => '2025-02-15',
            'reason' => 'Personal',
            'notes' => $this->faker->sentence,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Manager;
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
            'first_name'   => fake()->firstname,
            'last_name'   => fake()->lastname,
            'email'   => fake()->unique()->email(),
            'phone'   => fake()->phoneNumber(),
            'date_of_birth'   => fake()->date('Y-m-d', 'now'),
            'hire_date'   => fake()->dateTime('now'),
            'salary'   => fake()->numberBetween(30000, 100000),
            'is_active'   => rand(0, 1),
            'department_id'   => Department::inRandomOrder()->first()->id,
            'manager_id'   => Manager::inRandomOrder()->first()->id,
            'address'   => fake()->address,
        ];
    }
}

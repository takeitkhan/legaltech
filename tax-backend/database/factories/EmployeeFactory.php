<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'designation'=>['Data Entry Specialist','Manager','User','Admin'][random_int(0,3)],
            'phone'  => $this->faker->phoneNumber(),
            'entity_id' => random_int(1,5)
        ];
    }
}

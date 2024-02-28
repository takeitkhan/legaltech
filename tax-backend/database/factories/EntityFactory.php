<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entity>
 */
class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'           => $this->faker->company(),
            'bin'            => Str::random(20),
            'address'        => $this->faker->address(),
            'tin'            => Str::random(20),
            'entity_type_id' => random_int(1,2)
        ];
    }
}

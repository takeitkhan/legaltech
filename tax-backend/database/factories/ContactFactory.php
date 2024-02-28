<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'entity_id'=>random_int(1,5),
            'name'    => $this->faker->company(),
            'bin'      => Str::random(30),
             'contact_person' => $this->faker->name(),
             'nid'   => Str::random(20),
             'address' => $this->faker->address()
        ];
    }
}

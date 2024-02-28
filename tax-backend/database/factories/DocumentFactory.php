<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
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
            'file_extension'    => 'png',
            'user_id'           => random_int(2,5),
            // 'transaction_id'    => ,
            // 'entity_id'         => ,
            // 'document_type_id'  =>
        ];
    }
}

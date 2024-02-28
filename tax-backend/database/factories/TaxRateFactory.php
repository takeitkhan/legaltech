<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaxRate>
 */
class TaxRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $sd_rate_title=['15 %','5 %','30 %','40%'];
        $sd_rate = [15,5,30,40,50];
        return [
            'entity_id' => random_int(1,5),
            'details'   =>  $sd_rate[random_int(0,4)],
            'rate'      => $sd_rate[random_int(0,4)]
        ];
    }
}

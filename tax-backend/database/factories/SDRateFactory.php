<?php

namespace Database\Factories;

use App\Models\SdRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SDRate>
 */
class SDRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SdRate::class;
    public function definition()
    {
        // $sd_rate_title=['15 %','5 %','30 %','40%'];
        $sd_rate = [15,5,30,40,50];
        return [
            'entity_id' => random_int(1,5),
            'title'     =>  $sd_rate[random_int(0,4)],
            'rate'      => $sd_rate[random_int(0,4)]
        ];
    }
}

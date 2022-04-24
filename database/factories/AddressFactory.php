<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'street_name' => $this->faker->streetName ,
            'street_number' => $this->faker->numberBetween(1 , 5000 ) ,
            'city' => $this->faker->city ,
            'state' => $this->faker-> state ,
            'country' => $this->faker->country ,
            'post_code' => $this->faker->postcode ,


        ];
    }
}

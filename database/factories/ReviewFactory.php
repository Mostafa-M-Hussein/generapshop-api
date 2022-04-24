<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => $this->faker->numberBetween(1 , 500 ) ,
            'product_id' =>$this->faker->numberBetween(1 ,1500 ) ,
            'starts' => $this->faker-> numberBetween(1 , 5 ) ,
            'review' => $this->faker->paragraph() ,

        ];
    }
}

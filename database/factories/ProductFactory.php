<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2) ,
            'description' => $this->faker->paragraph(5) ,
            'unit' => $this->faker->randomLetter(     ) ,
            'price' => $this->faker->randomFloat(2 , 10 , 500  ) ,
            'total' => $this->faker-> numberBetween(2 , 250 ),
            'category_id' => $this->faker->numberBetween(1 , 50 )

        ];
    }
}

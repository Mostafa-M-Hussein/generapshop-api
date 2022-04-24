<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker-> numberBetween(0 ,101)  ,
            'order_id'=> $this->faker-> numberBetween(1 , 50 ) ,
            'title'=> $this->faker-> sentence  ,
            'message'=> $this->faker-> paragraph( 5 ) ,
            'ticket_type_id'=> $this->faker-> numberBetween(1 ,4 ) ,
            'status'=> $this->faker-> randomElement(['pending' , 'closed' , 'waiting'])
        ];
    }
}

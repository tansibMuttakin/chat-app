<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        do {
            $to = rand(1,10);
            $from = rand(1,10);
        } while ($to == $from);
        
        return [
            'to' => $to,
            'from' => $from,
            'text' => $this->faker->sentence(),
        ];
    }
}

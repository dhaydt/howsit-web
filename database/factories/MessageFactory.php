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

        return [
            'from' => $this->faker->numberBetween(1, 15),
            'to' => $this->faker->numberBetween(1, 15),
            'text' => $this->faker->sentence(),
        ];
    }
}

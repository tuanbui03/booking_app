<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;

class RoomFactory extends Factory
{
    protected $model = \App\Models\Room::class;

    public function definition()
    {
        $hotelIds = Hotel::pluck('id')->toArray();
        $types = ['double', 'deluxe', 'superior', 'junior'];

        return [
            'hotel_id' => $this->faker->randomElement($hotelIds),
            'room_number' => $this->faker->unique()->bothify('RM-###'),
            'type' => $this->faker->randomElement(['double', 'deluxe', 'superior', 'junior']),
            'price' => $this->faker->numberBetween(50, 300),
            'description' => $this->faker->sentence(),
        ];
    }
}

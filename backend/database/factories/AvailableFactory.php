<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

class AvailableFactory extends Factory
{
    protected $model = \App\Models\Available::class;

    public function definition()
    {
        $roomIds = Room::pluck('id')->toArray();

        $availableFrom = $this->faker->dateTimeBetween('2025-06-01', '2025-06-20');
        $availableTo = (clone $availableFrom)->modify('+' . rand(1, 365) . ' days');

        return [
            'room_id' => $this->faker->randomElement($roomIds),
            'available_from' => $availableFrom,
            'available_to' => $availableTo,
        ];
    }
}

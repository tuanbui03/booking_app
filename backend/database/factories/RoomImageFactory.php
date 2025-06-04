<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

class RoomImageFactory extends Factory
{
    protected $model = \App\Models\RoomImage::class;

    public function definition()
    {
        $roomIds = Room::pluck('id')->toArray();

        return [
            'room_id' => $this->faker->randomElement($roomIds),
            'image_url' => $this->faker->imageUrl(640, 480, 'room'),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Hotel;

class ReviewFactory extends Factory
{
    protected $model = \App\Models\Review::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $hotelIds = Hotel::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'hotel_id' => $this->faker->randomElement($hotelIds),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

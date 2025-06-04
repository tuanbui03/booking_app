<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Room;


class PaymentFactory extends Factory
{
    protected $model = \App\Models\Payment::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $roomIds = Room::pluck('id')->toArray();


        return [
            'user_id' => $this->faker->randomElement($userIds),
            'room_id' => $this->faker->randomElement($roomIds),
            'amount' => $this->faker->randomFloat(2, 20, 1000),
            'method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash']),
            'status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'paid_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

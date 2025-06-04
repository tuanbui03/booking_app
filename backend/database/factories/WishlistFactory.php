<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Review;

class WishlistFactory extends Factory
{
    protected $model = \App\Models\Wishlist::class;

    public function definition()
    {
        $reviewIds = Review::pluck('id')->toArray();

        return [
            'review_id' => $this->faker->randomElement($reviewIds),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

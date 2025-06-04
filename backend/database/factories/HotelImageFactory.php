<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelImageFactory extends Factory
{
    public function definition(): array
    {
        $hotel = Hotel::inRandomOrder()->first() ?? Hotel::factory()->create(); // ✅ đảm bảo luôn có hotel

        return [
            'hotel_id' => $hotel->id,
            'image_url' => $this->faker->imageUrl(640, 480, 'hotel', true),
        ];
    }
}

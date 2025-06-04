<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelImage;


class HotelImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelImage::factory()->count(15)->create();
    }
}

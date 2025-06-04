<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomImage;

class RoomImagesSeeder extends Seeder
{
    public function run()
    {
        RoomImage::factory()->count(20)->create();
    }
}

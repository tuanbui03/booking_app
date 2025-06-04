<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomsSeeder extends Seeder
{
    public function run()
    {
        Room::factory()->count(20)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Available;

class AvailableSeeder extends Seeder
{
    public function run()
    {
        Available::factory()->count(30)->create();
    }
}

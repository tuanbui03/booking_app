<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewsSeeder extends Seeder
{
    public function run()
    {
        Review::factory()->count(30)->create();
    }
}

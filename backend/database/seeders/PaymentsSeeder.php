<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentsSeeder extends Seeder
{
    public function run()
    {
        Payment::factory()->count(20)->create();
    }
}

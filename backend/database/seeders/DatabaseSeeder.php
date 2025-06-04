<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            HotelsSeeder::class,
            HotelImagesSeeder::class,
            RoomsSeeder::class,
            RoomImagesSeeder::class,
            AvailableSeeder::class,
            ReviewsSeeder::class,
            WishlistSeeder::class,
            PaymentsSeeder::class,
        ]);
    }
}

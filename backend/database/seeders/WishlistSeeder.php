<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function run()
    {
        // Lấy hotel_id có điểm đánh giá trung bình >= 4.5
        $topHotels = DB::table('reviews')
            ->select('hotel_id', DB::raw('AVG(rating) as avg_rating'))
            ->groupBy('hotel_id')
            ->having('avg_rating', '>=', 4.5)
            ->orderByDesc('avg_rating')
            ->limit(10)
            ->pluck('hotel_id')
            ->toArray();

        // Thêm vào bảng wishlists
        foreach ($topHotels as $hotelId) {
            DB::table('wishlists')->insert([
                'hotel_id' => $hotelId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class HotelFactory extends Factory
{
    protected $model = \App\Models\Hotel::class;

    public function definition()
    {
        // Lấy tất cả ID user có role hotel_manager
        $managerIds = User::whereHas('role', function ($q) {
            $q->where('name', 'hotel_manager');
        })->pluck('id')->toArray();

        // Nếu chưa có user nào có role hotel_manager thì tạo một
        if (empty($managerIds)) {
            $hotelManagerRole = Role::firstOrCreate(['name' => 'hotel_manager']);
            $newManager = User::factory()->create([
                'role_id' => $hotelManagerRole->id
            ]);
            $managerIds[] = $newManager->id;
        }

        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentence(),
            'manager_id' => $this->faker->randomElement($managerIds),
        ];
    }
}

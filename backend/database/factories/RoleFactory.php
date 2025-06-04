<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = \App\Models\Role::class;

    public function definition()
    {
        $roles = ['admin', 'hotel_manager', 'user'];
        return [
            'name' => $this->faker->unique()->randomElement($roles),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        $roleIds = Role::pluck('id')->toArray();

        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'password' => Hash::make('password'),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'dob' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'role_id' => $this->faker->randomElement($roleIds),
        ];
    }
}

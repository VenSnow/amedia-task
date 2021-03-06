<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$jXcaoGKKbhVF2FFzUeKVDeI2eyXqgMDxEQWEnMkHv.0oKhnNjYRL2', // manager
            'remember_token' => Str::random(10),
            'role' => 'MANAGER',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

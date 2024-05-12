<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
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
            'role' => $this->faker->randomElement(['user', 'group']),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('123456'), // password
            'remember_token' => Str::random(10),
            'profileImage' => '', 
        ];
    }
    
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'super_admin',
                'email' => 'super@admin.com',
                'password'=>bcrypt('admin1234'), 
            ];
        });
    }

    public function userTest()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'user',
                'email' => 'user@user.com', 
                'password'=>bcrypt('123456'), 
            ];
        });
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

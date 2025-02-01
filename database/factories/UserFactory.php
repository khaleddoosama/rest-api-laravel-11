<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'remember_token'=>Str::random(10),
            'password' => Hash::make('password'), // Default password
            'role' => 'user', // Default role for regular users
        ];
    }

    /**
     * Create a super admin user with default credentials.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function superAdmin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('superadmin123'),
                'role' => 'admin',
            ];
        });
    }
}
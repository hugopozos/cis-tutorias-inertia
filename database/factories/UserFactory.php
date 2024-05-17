<?php

namespace Database\Factories;

use App\Models\UniversityCareer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'email' => sprintf("l%d@veracruz.tecnm.mx", rand(20000000, 29999999)),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('Contraseña1234'),
            'birthday' => fake()->date(),
            'student_number' => sprintf("2%08d", rand(0, 99999999)),
            'university_career' => UniversityCareer::all()->random(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

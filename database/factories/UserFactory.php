<?php

namespace Database\Factories;

use App\Models\UniversityCareer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
        $studentNumber = sprintf("2%07d", rand(1000000, 9999999));

        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'email' => "l{$studentNumber}@veracruz.tecnm.mx",
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('Contrasena1234'),
            'birthday' => $this->faker->dateTimeBetween('-100 years', '-18 years')->format('Y-m-d'),
            'student_number' => "l" . + $studentNumber,
            'university_career' => UniversityCareer::all()->random()->name,
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

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function ($user) {
            $user->assignRole(Role::findByName('estudiante'));
        });
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Nette\Utils\Random;

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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'cpf' => fake()->numberBetween(10000000000, 99999999999),
            'phone' => fake()->phoneNumber(),
            'birth_date' => fake()->date(),
            'is_admin' => random_int(1, 10) == 1 ? 'true' : 'false',


        ];
    }

    // $table->id();
    // $table->string('name');
    // $table->string('email')->unique();
    // $table->timestamp('email_verified_at')->nullable();
    // $table->string('password');
    // $table->string('cpf');
    // $table->string('phone');
    // $table->date('birth_date');
    // $table->boolean('is_admin');
    // $table->rememberToken();
    // $table->timestamps();

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

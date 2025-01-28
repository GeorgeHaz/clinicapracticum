<?php

namespace Database\Factories;

use App\Models\Specialties;
use App\Models\Doctors;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctors>
 */
class DoctorsFactory extends Factory
{
    protected $model = Doctors::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'specialties_id' => Specialties::factory(),
            'dni' => fake()->unique()->numerify('##########'),
            'telephone' => fake()->phoneNumber(),
            'direction' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}

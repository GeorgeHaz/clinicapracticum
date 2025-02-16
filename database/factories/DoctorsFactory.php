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
            'dni' => $this->faker->unique()->numerify('##########'),
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'specialties_id' => Specialties::factory(),
            'direction' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
        ];
    }
}

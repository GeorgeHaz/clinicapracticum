<?php

namespace Database\Factories;

use App\Models\Secretaries;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Secretaries>
 */
class SecretariesFactory extends Factory
{
    protected $model = Secretaries::class;
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
            'direction' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}

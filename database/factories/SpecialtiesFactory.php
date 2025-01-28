<?php

namespace Database\Factories;

use App\Models\Specialties;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specialties>
 */
class SpecialtiesFactory extends Factory
{
    protected $model = Specialties::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(), 
        ];
    }
}

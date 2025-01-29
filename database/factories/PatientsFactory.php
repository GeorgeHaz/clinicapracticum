<?php

namespace Database\Factories;

use App\Models\Patients;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patients>
 */
class PatientsFactory extends Factory
{
    protected $model = Patients::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni' => $this->faker->unique()->numerify('##########'), // Ejemplo de DNI único
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birthdate' => $this->faker->date(),
            'gener' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'direction' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'allergies' => $this->faker->optional()->sentence,
            'diseases' => $this->faker->optional()->sentence,
            'emergency_contact_name' => $this->faker->name,
            'emergency_contact_telephone' => $this->faker->phoneNumber,
        ];
    }
}

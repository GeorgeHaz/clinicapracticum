<?php

namespace Database\Factories;

use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\Specialties;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointments>
 */
class AppointmentsFactory extends Factory
{
    protected $model = Appointments::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specialty = Specialties::factory()->create();
        $doctor = Doctors::factory()->create();

        return [
            'patients_id' => Patients::factory(),
            'doctors_id' => $doctor->id,
            'specialties_id' => $specialty->id,
            'appointments_date' => $this->faker->dateTimeBetween('+1 week', '+2 week')->format('Y-m-d'),
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'status' => $this->faker->randomElement(['Agendada', 'Confirmada', 'Cancelada', 'Realizada']),
            'observations' => $this->faker->sentence,
        ];
    }
}

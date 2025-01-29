<?php

namespace Database\Factories;

use App\Models\Doctors;
use App\Models\Histories;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Histories>
 */
class HistoriesFactory extends Factory
{
    protected $model = Histories::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        

        return [
            'patient_id' => Patients::factory(),
            'doctor_id' => Doctors::factory(),
            'entry_date' => $this->faker->date(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
<?php

namespace Tests\Feature;

use App\Models\Appointments;
use App\Models\Patients;
use App\Models\Specialties;
use App\Models\Doctors;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ProtoneMedia\Splade\Facades\Toast;

uses(RefreshDatabase::class);

test('prueba creacion de cita', function () {
    
    // Preparar datos de prueba
    $specialty = Specialties::factory()->create();
    $patient = Patients::factory()->create();
    $doctor = Doctors::factory()->create(['specialties_id' => $specialty->id]);

        // Crear un usuario con rol de secretaria
    $secretary = User::factory()->create(['rol' => 'Secretaria']);

        // Autenticar a la secretaria
        $this->actingAs($secretary);

        // Simular el envío del formulario de creación de cita
        $response = $this->post(route('appointments.store'), [
            'patients_id' => $patient->id,
            'doctors_id' => $doctor->id,
            'specialties_id' => $specialty->id,
            'appointments_date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '10:00',
            'status' => 'Agendada',
            'observations' => 'Test observation',
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('appointments.index'));

        // Verificar que la cita se creó en la base de datos con el estado correcto
        $this->assertDatabaseHas('appointments', [
            'patients_id' => $patient->id,
            'doctors_id' => $doctor->id,
            'specialties_id' => $specialty->id,
            'appointments_date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '10:00',
            'status' => 'Agendada',
            'observations' => 'Test observation',
        ]);
});

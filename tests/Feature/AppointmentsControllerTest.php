<?php

namespace Tests\Feature;

use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\Specialties;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_creaction_appointment()
    {
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
    }

    public function test_edit_appointment()
    {
        // Preparar datos de prueba
        $specialty = Specialties::factory()->create();
        $patient = Patients::factory()->create();
        $doctor = Doctors::factory()->create(['specialties_id' => $specialty->id]);

        $secretary = User::factory()->create(['rol' => 'Secretaria']);
        
        // Crear una cita
        $appointment = Appointments::factory()->create([
            'patients_id' => $patient->id,
            'doctors_id' => $doctor->id,
            'specialties_id' => $specialty->id,
            'appointments_date' => now()->addDays(2)->format('Y-m-d'),
            'start_time' => '11:00',
            'end_time' => '12:00',
            'status' => 'Agendada',
        ]);

        // Crear un usuario con rol de secretaria
        

        // Autenticar a la secretaria
        $this->actingAs($secretary);

        // Simular la petición GET para obtener el formulario de edición
        $response = $this->get(route('appointments.edit', $appointment->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();
        $response->assertSee($patient->name);

        // Simular la modificación de la hora de la cita y el envío del formulario
        $newStartTime = '14:00';
        $newEndTime = '15:00';
        $response = $this->patch(route('appointments.update', $appointment->id), [
            'patients_id' => $patient->id,
            'doctors_id' => $doctor->id,
            'specialties_id' => $specialty->id,
            'appointments_date' => $appointment->appointments_date,
            'start_time' => $newStartTime,
            'end_time' => $newEndTime,
            'status' => 'Realizada', // Modificar el estado a 'Realizada'
            'observations' => 'Updated observation',
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('appointments.index'));

        // Verificar que la cita se actualizó en la base de datos con los nuevos valores
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'patients_id' => $patient->id,
            'doctors_id' => $doctor->id,
            'specialties_id' => $specialty->id,
            'appointments_date' => $appointment->appointments_date,
            'start_time' => $newStartTime,
            'end_time' => $newEndTime,
            'status' => 'Realizada',
            'observations' => 'Updated observation',
        ]);
    }

    public function test_eliminar_appointment()
    {
        // Preparar datos de prueba
        $specialty = Specialties::factory()->create();
        $patient = Patients::factory()->create();
        $doctor = Doctors::factory()->create(['specialties_id' => $specialty->id]);

        // Crear un usuario con rol de secretaria
        $secretary = User::factory()->create(['rol' => 'Secretaria']);

        // Crear una cita
        $appointment = Appointments::factory()->create([
            'patients_id' => $patient->id,
            'doctors_id' => $doctor->id,
            'specialties_id' => $specialty->id,
            'appointments_date' => now()->addDays(2)->format('Y-m-d'),
            'start_time' => '11:00',
            'end_time' => '12:00',
            'status' => 'Agendada',
        ]);

        // Autenticar a la secretaria
        $this->actingAs($secretary);

        // Simular la solicitud DELETE para eliminar la cita
        $response = $this->delete(route('appointments.destroy', $appointment->id));

        // Verificar redirección exitosa
        $response->assertRedirect(route('appointments.index'));

        // Verificar que la cita fue eliminada (o marcada como eliminada si usas SoftDeletes)
        $this->assertSoftDeleted('appointments', [
            'id' => $appointment->id,
        ]);
    }
}
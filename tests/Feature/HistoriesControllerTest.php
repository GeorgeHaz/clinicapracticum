<?php

namespace Tests\Feature;

use App\Models\Doctors;
use App\Models\Histories;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HistoriesControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_ver_historia_clinica()
    {
        // Crear un usuario con rol de médico
        $doctor1 = User::factory()->create(['rol' => 'Medico']);

        // Autenticar al médico
        $this->actingAs($doctor1);

        // Crear un paciente
        $patient = Patients::factory()->create();
        $doctor = Doctors::factory()->create();

        // Crear algunos registros de historial clínico para el paciente
        $history = Histories::factory()->create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'entry_date' => now()->subDays(5),
            'description' => 'Primera consulta',
        ]);

        // Simular la solicitud GET a la ruta de la historia clínica del paciente
        $response = $this->get(route('histories.show', $history->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();

        $response->assertSee($patient->name . ' ' . $patient->last_name);
        $response->assertSee($doctor->name . ' ' . $doctor->last_name);
        $response->assertSee($history->entry_date);
        $response->assertSee($history->description);
    }

    public function test_creacion_historia()
    {
        // Preparar datos de prueba
        $doctor1 = User::factory()->create(['rol' => 'Medico']);
        $patient = Patients::factory()->create();
        $doctor = Doctors::factory()->create();

        // Autenticar a la secretaria
        $this->actingAs($doctor1);

        // Simular el envío del formulario de creación de cita
        $response = $this->post(route('histories.store'), [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'entry_date' => now()->subDays(5),
            'description' => 'Problema estomacal',
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('histories.index'));

        // Verificar que la historia se creó en la base de datos con el estado correcto
        $this->assertDatabaseHas('histories', [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'entry_date' => now()->subDays(5),
            'description' => 'Problema estomacal',
        ]);
    }

    public function test_edit_historia()
    {
        // Preparar datos de prueba
        $doctor1 = User::factory()->create(['rol' => 'Medico']);
        $patient = Patients::factory()->create();
        $doctor = Doctors::factory()->create();

        // Autenticar a la secretaria
        $this->actingAs($doctor1);
        
        // Crear una cita
        $history = Histories::factory()->create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'entry_date' => now()->subDays(5),
            'description' => 'Problema estomacal',
        ]);

        // Simular la petición GET para obtener el formulario de edición
        $response = $this->get(route('histories.edit', $history->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();
        $response->assertSee($patient->name);

        // Simular la modificación de la hora de la cita y el envío del formulario
        $newDescription = 'Problema intestinal severo';
        $response = $this->patch(route('histories.update', $history->id), [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'entry_date' => now()->subDays(5),
            'description' => $newDescription,
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('histories.index'));

        // Verificar que la cita se actualizó en la base de datos con los nuevos valores
        $this->assertDatabaseHas('histories', [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'entry_date' => now()->subDays(5),
            'description' => $newDescription,
        ]);
    }

    public function test_eliminar_historia()
    {
        // Preparar datos de prueba
        $doctor1 = User::factory()->create(['rol' => 'Medico']);
        $patient = Patients::factory()->create();
        $doctor = Doctors::factory()->create();

        // Autenticar a la secretaria
        $this->actingAs($doctor1);

        // Crear una hisotoria
        $history = Histories::factory()->create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'entry_date' => now()->subDays(5),
            'description' => 'Problema estomacal',
        ]);

        // Simular la solicitud DELETE para eliminar la cita
        $response = $this->delete(route('histories.destroy', $history->id));

        // Verificar redirección exitosa
        $response->assertRedirect(route('histories.index'));

        // Verificar que la cita fue eliminada (o marcada como eliminada si usas SoftDeletes)
        $this->assertSoftDeleted('histories', [
            'id' => $history->id,
        ]);
    }
}

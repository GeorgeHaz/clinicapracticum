<?php

namespace Tests\Feature;

use App\Models\Doctors;
use App\Models\Specialties;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorsControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_ver_medico()
    {
        // Crear un usuario con rol de médico
        $admin = User::factory()->create(['rol' => 'Administrador']);
        $specialty=Specialties::factory()->create();

        // Autenticar al médico
        $this->actingAs($admin);

        // Crear algunos registros de historial clínico para el paciente
        $doctor = Doctors::create([
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'email' => 'truman@gmail.com',
            'specialties_id' => $specialty->id,
            'telephone' => '0928372837',
            'direction' => 'Street hollywoos',
        ]);

        // Simular la solicitud GET a la ruta de la historia clínica del paciente
        $response = $this->get(route('doctors.show', $doctor->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();

        $response->assertSee($doctor->dni);
        $response->assertSee($doctor->name);
        $response->assertSee($doctor->last_name);
        $response->assertSee($doctor->email);
        $response->assertSee($specialty->name);
        $response->assertSee($doctor->telephone);
        $response->assertSee($doctor->direction);
    }

    public function test_creacion_medico()
    {
        // Preparar datos de prueba
        $admin = User::factory()->create(['rol' => 'Administrador']);
        $specialty=Specialties::factory()->create();

        // Autenticar a la secretaria
        $this->actingAs($admin);

        // Simular el envío del formulario de creación de cita
        $response = $this->post(route('doctors.store'), [
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'email' => 'truman@gmail.com',
            'specialties_id' => $specialty->id,
            'telephone' => '0928372837',
            'direction' => 'Street hollywoos',
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('doctors.index'));

        // Verificar que la historia se creó en la base de datos con el estado correcto
        $this->assertDatabaseHas('doctors', [
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'email' => 'truman@gmail.com',
            'specialties_id' => $specialty->id,
            'telephone' => '0928372837',
            'direction' => 'Street hollywoos',
        ]);
    }

    public function test_edit_medico()
    {
        // Preparar datos de prueba
        $admin = User::factory()->create(['rol' => 'Administrador']);
        $specialty = Specialties::factory()->create();

        // Autenticar a la secretaria
        $this->actingAs($admin);
        
        // Crear una cita
        $doctor = Doctors::factory()->create([
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'email' => 'truman@gmail.com',
            'specialties_id' => $specialty->id,
            'telephone' => '0928372837',
            'direction' => 'Street hollywoos',
        ]);

        // Simular la petición GET para obtener el formulario de edición
        $response = $this->get(route('doctors.edit', $doctor->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();
        $response->assertSee($doctor->name);

        // Simular la modificación de la hora de la cita y el envío del formulario
        $newLastName = 'Rodriguez';
        $response = $this->patch(route('doctors.update', $doctor->id), [
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => $newLastName,
            'email' => 'truman@gmail.com',
            'specialties_id' => $specialty->id,
            'telephone' => '0928372837',
            'direction' => 'Street hollywoos',
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('doctors.index'));

        // Verificar que la cita se actualizó en la base de datos con los nuevos valores
        $this->assertDatabaseHas('doctors', [
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => $newLastName,
            'email' => 'truman@gmail.com',
            'specialties_id' => $specialty->id,
            'telephone' => '0928372837',
            'direction' => 'Street hollywoos',
        ]);
    }

    public function test_eliminar_medico()
    {
        // Preparar datos de prueba
        $admin = User::factory()->create(['rol' => 'Administrador']);
        $specialty = Specialties::factory()->create();

        // Autenticar a la secretaria
        $this->actingAs($admin);

        // Crear una hisotoria
        $doctor = Doctors::factory()->create([
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'email' => 'truman@gmail.com',
            'specialties_id' => $specialty->id,
            'telephone' => '0928372837',
            'direction' => 'Street hollywoos',
        ]);

        // Simular la solicitud DELETE para eliminar la cita
        $response = $this->delete(route('doctors.destroy', $doctor->id));

        // Verificar redirección exitosa
        $response->assertRedirect(route('doctors.index'));

        // Verificar que la cita fue eliminada (o marcada como eliminada si usas SoftDeletes)
        $this->assertDatabaseMissing('doctors', [
            'id' => $doctor->id,
        ]);
    }
}

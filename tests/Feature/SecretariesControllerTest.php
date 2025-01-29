<?php

namespace Tests\Feature;

use App\Models\Doctors;
use App\Models\Secretaries;
use App\Models\Specialties;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecretariesControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_ver_secretaria()
    {
        // Crear un usuario con rol de médico
        $admin = User::factory()->create(['rol' => 'Administrador']);

        // Autenticar al médico
        $this->actingAs($admin);

        // Crear algunos registros de historial clínico para el paciente
        $secretary = Secretaries::create([
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'direction' => 'Street hollywoos',
            'telephone' => '0928372837',
            'email' => 'truman@gmail.com',
        ]);

        // Simular la solicitud GET a la ruta de la historia clínica del paciente
        $response = $this->get(route('secretaries.show', $secretary->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();

        $response->assertSee($secretary->dni);
        $response->assertSee($secretary->name);
        $response->assertSee($secretary->last_name);
        $response->assertSee($secretary->direction);
        $response->assertSee($secretary->telephone);
        $response->assertSee($secretary->email);

    }

    public function test_creacion_secretaria()
    {
        // Preparar datos de prueba
        $admin = User::factory()->create(['rol' => 'Administrador']);

        // Autenticar a la secretaria
        $this->actingAs($admin);

        // Simular el envío del formulario de creación de cita
        $response = $this->post(route('secretaries.store'), [
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'direction' => 'Street hollywoos',
            'telephone' => '0928372837',
            'email' => 'truman@gmail.com',
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('secretaries.index'));

        // Verificar que la historia se creó en la base de datos con el estado correcto
        $this->assertDatabaseHas('secretaries', [
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'direction' => 'Street hollywoos',
            'telephone' => '0928372837',
            'email' => 'truman@gmail.com',
        ]);
    }

    public function test_edit_secretarias()
    {
        // Preparar datos de prueba
        $admin = User::factory()->create(['rol' => 'Administrador']);

        // Autenticar a la secretaria
        $this->actingAs($admin);
        
        // Crear una cita
        $secretary = Secretaries::factory()->create([
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'direction' => 'Street hollywoos',
            'telephone' => '0928372837',
            'email' => 'truman@gmail.com',
        ]);

        // Simular la petición GET para obtener el formulario de edición
        $response = $this->get(route('secretaries.edit', $secretary->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();
        $response->assertSee($secretary->name);

        // Simular la modificación de la hora de la cita y el envío del formulario
        $newLastName = 'Rodriguez';
        $response = $this->patch(route('secretaries.update', $secretary->id), [
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => $newLastName,
            'direction' => 'Street hollywoos',
            'telephone' => '0928372837',
            'email' => 'truman@gmail.com',
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('secretaries.index'));

        // Verificar que la cita se actualizó en la base de datos con los nuevos valores
        $this->assertDatabaseHas('secretaries', [
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => $newLastName,
            'direction' => 'Street hollywoos',
            'telephone' => '0928372837',
            'email' => 'truman@gmail.com',
        ]);
    }

    public function test_eliminar_secretaria()
    {
        // Preparar datos de prueba
        $admin = User::factory()->create(['rol' => 'Administrador']);

        // Autenticar a la secretaria
        $this->actingAs($admin);

        // Crear una hisotoria
        $secretary = Secretaries::factory()->create([
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'direction' => 'Street hollywoos',
            'telephone' => '0928372837',
            'email' => 'truman@gmail.com',
        ]);

        // Simular la solicitud DELETE para eliminar la cita
        $response = $this->delete(route('secretaries.destroy', $secretary->id));

        // Verificar redirección exitosa
        $response->assertRedirect(route('secretaries.index'));

        // Verificar que la cita fue eliminada (o marcada como eliminada si usas SoftDeletes)
        $this->assertDatabaseMissing('secretaries', [
            'id' => $secretary->id,
        ]);
    }
}

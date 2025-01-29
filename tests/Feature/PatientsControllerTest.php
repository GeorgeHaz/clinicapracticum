<?php

namespace Tests\Feature;

use App\Models\Patients;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PatientsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ver_paciente()
    {
        // Crear un usuario con rol de médico
        $admin = User::factory()->create(['rol' => 'Administrador']);

        // Autenticar al médico
        $this->actingAs($admin);

        // Crear algunos registros de historial clínico para el paciente
        $patient = Patients::factory()->create([
            'dni' => '0987654321',
            'name' => 'Jane',
            'last_name' => 'Smith',
            'birthdate' => '1990-05-15',
            'gener' => 'Femenino',
            'direction' => '123 Main St',
            'telephone' => '555-1234',
            'email' => 'janesmih@gmail.com',
            'blood_group' => 'O+',
            'allergies' => 'Ninguna',
            'diseases' => 'Ninguna',
            'emergency_contact_name' => 'Peter Smith',
            'emergency_contact_telephone' => '555-5678',
        ]);

        // Simular la solicitud GET a la ruta de la historia clínica del paciente
        $response = $this->get(route('patients.show', $patient->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();

        $response->assertSee($patient->dni);
        $response->assertSee($patient->name);
        $response->assertSee($patient->birthdate);
        $response->assertSee($patient->gener);
        $response->assertSee($patient->direction);
        $response->assertSee($patient->telephone);
        $response->assertSee($patient->email);
        $response->assertSee($patient->blood_group);
        $response->assertSee($patient->allergies);
        $response->assertSee($patient->diseases);
        $response->assertSee($patient->emergency_contact_name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Crear un usuario administrador
        $this->admin = User::factory()->create([
            'dni' => '2374834627',
            'email' => 'jasm@gmail.com',
            'user' => 'jasm',
            'name' => 'juanito',
            'last_name' => 'perez',
            'rol' => 'Administrador',
        ]);

        // Autenticar al usuario administrador
        $this->actingAs($this->admin);
    }

    public function test_puede_almacenar_pacientes_y_crear_usuarios()
    {
        // Datos de prueba para el paciente
        $patientData = [
            'dni' => '0987654321',
            'name' => 'Jane',
            'last_name' => 'Smith',
            'birthdate' => '1990-05-15',
            'gener' => 'Femenino',
            'direction' => '123 Main St',
            'telephone' => '555-1234',
            'email' => 'janesmih@gmail.com',
            'blood_group' => 'O+',
            'allergies' => 'Ninguna',
            'diseases' => 'Ninguna',
            'emergency_contact_name' => 'Peter Smith',
            'emergency_contact_phone' => '555-5678',
        ];

        // Simular la solicitud POST a la ruta de creación de pacientes
        $response = $this->post(route('patients.store'), $patientData);

        // Verificar que la redirección fue exitosa al listado de pacientes
        $response->assertRedirect(route('patients.index'));

        // Verificar que el paciente fue registrado en la base de datos
        $this->assertDatabaseHas('patients', [
            'dni' => $patientData['dni'],
            'email' => $patientData['email'],
            'name' => $patientData['name'],
        ]);

        // Verificar que el usuario fue registrado en la base de datos
        $this->assertDatabaseHas('users', [
            'dni' => $patientData['dni'],
            'email' => $patientData['email'],
            'name' => $patientData['name'],
            'rol' => 'Paciente', // Según lo configurado en el método `createUserAccount`
        ]);

        // Obtener el paciente creado
        $patient = Patients::where('dni', $patientData['dni'])->first();

        // Verificar que se creó un usuario asociado al paciente
        $this->assertNotNull($patient->user);
        $this->assertEquals('Paciente', $patient->user->rol);

        // Verificar que la contraseña del usuario es correcta (DNI hasheado)
        $this->assertTrue(Hash::check($patientData['dni'], $patient->user->password));
    }

    public function test_edit_paciente()
    {
        // Preparar datos de prueba
        $admin = User::factory()->create(['rol' => 'Administrador']);

        // Autenticar a la secretaria
        $this->actingAs($admin);
        
        // Crear una cita
        $patient = Patients::factory()->create([
            'dni' => '0987654321',
            'name' => 'Jane',
            'last_name' => 'Smith',
            'birthdate' => '1990-05-15',
            'gener' => 'Femenino',
            'direction' => '123 Main St',
            'telephone' => '555-1234',
            'email' => 'janesmih@gmail.com',
            'blood_group' => 'O+',
            'allergies' => 'Ninguna',
            'diseases' => 'Ninguna',
            'emergency_contact_name' => 'Peter Smith',
            'emergency_contact_telephone' => '555-5678',
        ]);

        // Simular la petición GET para obtener el formulario de edición
        $response = $this->get(route('patients.edit', $patient->id));

        // Verificar que la vista se cargó correctamente
        $response->assertOk();
        $response->assertSee($patient->name);

        // Simular la modificación de la hora de la cita y el envío del formulario
        $newTelephone = '0928173828';
        $response = $this->patch(route('patients.update', $patient->id), [
            'dni' => '0987654321',
            'name' => 'Jane',
            'last_name' => 'Smith',
            'birthdate' => '1990-05-15',
            'gener' => 'Femenino',
            'direction' => '123 Main St',
            'telephone' => $newTelephone,
            'email' => 'janesmih@gmail.com',
            'blood_group' => 'O+',
            'allergies' => 'Ninguna',
            'diseases' => 'Ninguna',
            'emergency_contact_name' => 'Peter Smith',
            'emergency_contact_telephone' => '555-5678',
        ]);

        // Verificar redirección exitosa
        $response->assertRedirect(route('patients.index'));

        // Verificar que la cita se actualizó en la base de datos con los nuevos valores
        $this->assertDatabaseHas('patients', [
            'dni' => '0987654321',
            'name' => 'Jane',
            'last_name' => 'Smith',
            'birthdate' => '1990-05-15',
            'gener' => 'Femenino',
            'direction' => '123 Main St',
            'telephone' => $newTelephone,
            'email' => 'janesmih@gmail.com',
            'blood_group' => 'O+',
            'allergies' => 'Ninguna',
            'diseases' => 'Ninguna',
            'emergency_contact_name' => 'Peter Smith',
            'emergency_contact_telephone' => '555-5678',
        ]);
    }

    public function test_eliminar_paciente()
    {
        // Preparar datos de prueba
        $admin = User::factory()->create(['rol' => 'Administrador']);

        // Autenticar al admin
        $this->actingAs($admin);

        // Crear una hisotoria
        $patient = Patients::factory()->create([
            'dni' => '0987654321',
            'name' => 'Jane',
            'last_name' => 'Smith',
            'birthdate' => '1990-05-15',
            'gener' => 'Femenino',
            'direction' => '123 Main St',
            'telephone' => '555-1234',
            'email' => 'janesmih@gmail.com',
            'blood_group' => 'O+',
            'allergies' => 'Ninguna',
            'diseases' => 'Ninguna',
            'emergency_contact_name' => 'Peter Smith',
            'emergency_contact_telephone' => '555-5678',
        ]);

        // Simular la solicitud DELETE para eliminar la cita
        $response = $this->delete(route('patients.destroy', $patient->id));

        // Verificar redirección exitosa
        $response->assertRedirect(route('patients.index'));

        // Verificar que la cita fue eliminada (o marcada como eliminada si usas SoftDeletes)
        $this->assertDatabaseMissing('patients', [
            'id' => $patient->id,
        ]);
    }
}

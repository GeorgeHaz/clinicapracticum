<?php

use App\Models\Patients;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\post;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Crear un usuario administrador
    $this->admin = User::factory()->create([
        'dni' => '2374834627',
        'user' => 'jasm',
        'name'=>'juanito',
        'last_name'=>'perez',
        'rol' => 'Administrador',
    ]);

    // Autenticar al usuario administrador
    $this->actingAs($this->admin);
});

test('puede almacenar pacientes y crear usuarios', function () {


    // Datos de prueba para el paciente
    $patientData = [
        'dni' => '0987654321',
        'name' => 'Jane',
        'last_name' => 'Smith',
        'birthdate' => '1990-05-15',
        'gener' => 'Femenino',
        'direction' => '123 Main St',
        'telephone' => '555-1234',
        'email' => 'janesmih@example.com',
        'blood_group' => 'O+',
        'allergies' => 'Ninguna',
        'diseases' => 'Ninguna',
        'emergency_contact_name' => 'Peter Smith',
        'emergency_contact_phone' => '555-5678',
    ];

    // Simular la solicitud POST a la ruta de creación de pacientes
    $response = post(route('patients.store'), $patientData);

    // Verificar que la redirección fue exitosa al listado de pacientes
    $response->assertRedirect(route('patients.index'));

    // Verificar que el paciente fue registrado en la base de datos
    assertDatabaseHas('patients', [
        'dni' => $patientData['dni'],
        'email' => $patientData['email'],
        'name' => $patientData['name'],
    ]);

    assertDatabaseHas('users', [
        'dni' => $patientData['dni'],
        'email' => $patientData['email'],
        'name' => $patientData['name'],
        'rol' => 'Paciente', // Según lo configurado en el método `createUserAccount`
    ]);

    // Obtener el paciente creado
    $patient = Patients::where('dni', $patientData['dni'])->first();

    // Verificar que se creó un usuario asociado al paciente
    expect($patient->user)->not()->toBeNull()->and($patient->user->rol)->toBe('Paciente');

    // Verificar que la contraseña del usuario es correcta (DNI hasheado)
    $this->assertTrue(Hash::check($patientData['dni'], $patient->user->password));
});
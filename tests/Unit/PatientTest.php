<?php

use App\Models\Patients;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('crear usuario desde paciente', function () {

    $user = User::where('email', 'admin@admin.com')->first();

    $this->actingAs($user);

    $patient = Patients::create([
        'dni' => '0999999999',
        'name' => 'Truman',
        'last_name' => 'Defoe',
        'birthdate' => '2000-01-01',
        'gender' => 'Masculino',
        'address' => 'Street hollywoos',
        'phone' => '0928372837',
        'email' => 'truman@gmail.com',
        'blood_group' => 'A-',
        'allergies' => 'ninguna',
        'diseases' => 'ninguna',
        'emergency_contact_name' => 'Lisa',
        'emergency_contact_phone' => '0938293829',
    ]);

    // 2. Llamar al método que crea la cuenta de usuario
    $patient->createUserAccount();

    // 3. Verificar que el usuario se creó en la base de datos
    $this->assertDatabaseHas('users', [
        'email' => 'truman@gmail.com', // Usar el email del paciente
        'rol' => 'Paciente',
    ]);

    // 4. Obtener el usuario creado
    $user = User::where('email', 'truman@gmail.com')->first();

    // 5. Verificar que la contraseña se ha hasheado correctamente
    $this->assertTrue(Hash::check($patient->dni, $user->password));

    // 6. Verificar que el ID del usuario se ha guardado en el paciente
    $this->assertEquals($user->id, $patient->user_id);
});

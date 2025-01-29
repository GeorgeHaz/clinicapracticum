<?php

namespace Tests\Unit;

use App\Models\Doctors;
use App\Models\Specialties;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DoctorsTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_usuario_desde_doctor()
    {
        $specialty=Specialties::factory()->create();

        $doctor = Doctors::create([
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'email' => 'truman@gmail.com',
            'specialties_id' => $specialty->id,
            'telephone' => '0928372837',
            'direction' => 'Street hollywoos',
        ]);

        // 2. Llamar al método que crea la cuenta de usuario
        $doctor->createUserAccount();

        // 3. Verificar que el usuario se creó en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'truman@gmail.com',
            'rol' => 'Medico',
        ]);

        // 4. Obtener el usuario creado
        $user = User::where('email', 'truman@gmail.com')->first();

        // 5. Verificar que la contraseña se ha hasheado correctamente
        $this->assertTrue(Hash::check($doctor->dni, $user->password));

        // 6. Verificar que el ID del usuario se ha guardado en el paciente
        $this->assertEquals($user->id, $doctor->user_id);
    }
}

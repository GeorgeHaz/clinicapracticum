<?php

namespace Tests\Unit;

use App\Models\Secretaries;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecretariesTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_usuario_desde_secretaria()
    {
        // 1. Crear un paciente de prueba directamente
        $secretary = Secretaries::create([
            'dni' => '0999999999',
            'name' => 'Truman',
            'last_name' => 'Defoe',
            'direction' => 'Street hollywoos',
            'telephone' => '0928372837',
            'email' => 'truman@gmail.com',
        ]);

        // 2. Llamar al método que crea la cuenta de usuario
        $secretary->createUserAccount();

        // 3. Verificar que el usuario se creó en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'truman@gmail.com',
            'rol' => 'Secretaria',
        ]);

        // 4. Obtener el usuario creado
        $user = User::where('email', 'truman@gmail.com')->first();

        // 5. Verificar que la contraseña se ha hasheado correctamente
        $this->assertTrue(Hash::check($secretary->dni, $user->password));

        // 6. Verificar que el ID del usuario se ha guardado en el paciente
        $this->assertEquals($user->id, $secretary->user_id);
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_user_desde()
    {
        $response = $this->post('/register', [
            'dni' => '0999999999',
            'name' => 'John Wash',
            'last_name' => 'Doe Spencer',
            'user' => 'Xiobar',
            'email' => 'johndoe@example.com',
            'rol' => 'Administrador',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/dashboard'); // Ajusta según tu redirección post-registro

        // Verificar que el usuario se creó en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
        ]);

        // Verificar que la contraseña está encriptada
        $user = User::where('email', 'johndoe@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }
}

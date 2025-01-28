<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\post;

test('permite que un usuario se registre con exito', function () {
    $response = post('/register', [
        'dni'=>'0999999999',
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
});

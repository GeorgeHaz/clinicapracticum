<?php

use App\Models\Patients;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Hash;

test('crear cuenta usuario en paciente', function () {
    $patient = Patients::factory()->create([
        'name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
        'dni' => '1234567890',
    ]);

    $patient->createUserAccount();

    $this->assertDatabaseHas('users',[
        'email' => 'john.doe@example.com',
        'user' => '1234567890', // DNI como nombre de usuario
        'rol' => 'Paciente',
    ]);

    $user = User::where('email','john.doe@example.com')->first();

    expect(Hash::check($patient->dni, $user->password))->toBeTrue();

    expect($user->id)->toEqual($patient->user_id);
});

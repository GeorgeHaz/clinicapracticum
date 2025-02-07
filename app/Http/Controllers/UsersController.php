<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\User;
use App\Tables\UsersTable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('users.index',[
            'user' => UsersTable::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required','exists:roles,name'],
        ]);

        // Crear un nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'user' => $request->user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);

        Toast::title('Registro Exitoso')->autoDismiss(3);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('users.index');
    }

    public function promote(User $user)
    {
        // Verificar que el usuario sea invitado
        if (!$user->hasRole('Invitado')) {
            Toast::warning('Este usuario no es un invitado.')->autoDismiss(5);
            return redirect()->back();
        }

        return view('users.promote', compact('user'));
    }

    public function promoteStore(Request $request, User $user)
    {
        // Verificar que el usuario sea invitado - Doble verificación por seguridad
        if (!$user->hasRole('Invitado')) {
            Toast::warning('Este usuario no es un invitado.')->autoDismiss(5);
            return redirect()->back();
        }

        // 1. Actualizar el rol del usuario a 'Paciente' usando syncRoles
        $user->syncRoles(['Paciente']);

        // 2. Crear el registro del paciente *si no existe*.
        // Usamos firstOrCreate() para evitar duplicados.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // La cedula, unica en patients y en users
            'dni' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patients', 'dni'),  // Única en patients
                //Rule::unique('users', 'dni')->ignore($user->id), // Única en users, EXCEPTO para el usuario actual
            ],
            'birthdate' => 'required|date',
            'gender' => 'required|in:Masculino,Femenino,Otro',
            'address' => 'required',
            'phone' => 'required|max:255',
            'email' => [
                'nullable',
                'email:rfc,dns',
                Rule::unique('patients', 'email')->ignore($user->patient), // Único en la tabla patients, excepto para el paciente actual.
                Rule::unique('users', 'email')->ignore($user->id),    // Único en la tabla users, excepto para este usuario
            ],
            'blood_group' => 'nullable|max:255',  //Estos se dejan como estaban
            'allergies' => 'nullable',
            'diseases' => 'nullable',
            'emergency_contact_name' => 'nullable|max:255',
            'emergency_contact_phone' => 'nullable|max:255',
        ]);
    
        // 3. Actualizar la información del usuario *antes* de crear el Paciente.
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
        
        // 3. Crear el registro del paciente.
        $patient = Patients::firstOrCreate(
            ['user_id' => $user->id], // Busca un paciente con ese user_id
            [   // Si no lo encuentra, crea uno nuevo con estos datos:
                'user_id' => $user->id, // El user_id es lo PRIMERO, para que funcione firstOrCreate
                'name' => $validatedData['name'],
                'last_name' => $validatedData['last_name'],
                'dni' => $validatedData['dni'],
                'birthdate' => $validatedData['birthdate'],
                'gender' => $validatedData['gender'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'blood_group' => $validatedData['blood_group'],
                'allergies' => $validatedData['allergies'],
                'diseases' => $validatedData['diseases'],
                'emergency_contact_name' => $validatedData['emergency_contact_name'],
                'emergency_contact_phone' => $validatedData['emergency_contact_phone'],
            ]
        );

        $user->syncRoles(['Paciente']);

        Toast::success('Usuario promovido a Paciente exitosamente.')->autoDismiss(5);
        return to_route('patients.index'); // Redirige a la lista de *pacientes*, no de usuarios
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //$roles = Role::pluck('name', 'name')->all(); // Obte
        return view('users.edit', compact('user'/*,'roles'*/));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            //'role' => 'required|exists:roles,name',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'user' => $validatedData['user'],
        ]);
        
        //$user->syncRoles($request->role);

        Toast::title('Usuario actualizado exitosamente')
            ->autoDismiss(3);

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        Toast::title('Usuario eliminado')
            ->autoDismiss(3);

        return to_route('users.index');
    }
}

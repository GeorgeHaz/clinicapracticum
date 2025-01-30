<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\User;
use App\Tables\UsersTable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'user' => UsersTable::class
        ]);
    }

    public function guests()
    {
        $invitados = User::where('rol', 'Invitado')->paginate(10); // Obtiene los usuarios invitados y los pagina
        return view('users.guests', compact('guests'));
    }

    public function promote(User $user)
    {
        return view('users.promote', compact('user'));
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
            'dni' => ['required', 'string', 'max:10'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required', 'string', 'in:Paciente,Medico,Secretaria,Administrador,Invitado'],
        ]);

        // Crear un nuevo usuario
        User::create([
            'dni' => $request->dni,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'user' => $request->user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        Toast::title('Registro Exitoso')->autoDismiss(3);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('users.index');
    }

    public function promoteStore(Request $request, User $user)
    {
        // Actualizar el rol del usuario a 'Paciente'
        $user->update(['rol' => 'Paciente']);

        // Crear un nuevo registro en la tabla de pacientes
        $patient = Patients::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'dni' => $user->dni, // Suponiendo que los pacientes también tienen un DNI
            'email' => $user->email,
            'phone' => $user->telephone, // Suponiendo que estos campos existen en la tabla de usuarios
            'address' => $user->direction, // Suponiendo que estos campos existen en la tabla de usuarios
        ]);

        Toast::title('Usuario promovido a Paciente exitosamente')
            ->autoDismiss(5);

        return to_route('patients.index');
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
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'dni' => 'required|string|max:255|unique:users,dni,' . $user->id,
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
        ]);

        $user->update($validatedData);

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

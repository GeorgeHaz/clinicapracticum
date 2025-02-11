<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Specialties;
use App\Tables\DoctorsTable;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('doctors.index', [
            'doctors' => DoctorsTable::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialties::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|unique:patients|max:255', // Asegura que la cédula sea única
            'address' => 'required',
            'phone' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
            'specialty_id' => 'required|exists:specialties,id',
        ]);

        $doctor = Doctors::create($validatedData);
        $doctor->createUserAccount($doctor->dni);
        
        Toast::title('Medico creado exitosamente')
            ->autoDismiss(3);

        // Puedes usar to_route() si tienes el paquete 'protonemedia/inertiajs-tables-laravel-query-builder' instalado
        return to_route('doctors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctors $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctors $doctor)
    {
        $specialties = Specialties::all();
        return view('doctors.edit', compact('doctor', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctors $doctor)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:doctors,dni,' . $doctor->id,
            'address' => 'required',
            'phone' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
            'specialty_id' => 'required|exists:specialties,id',
        ]);

        $doctor->update($validatedData);

        Toast::title('Medico actualizado exitosamente')
            ->autoDismiss(3);

        return to_route('doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctors $doctor)
    {
        $doctor->delete();

        Toast::title('Doctor eliminado')
            ->autoDismiss(3);

        return to_route('doctors.index');
    }
}

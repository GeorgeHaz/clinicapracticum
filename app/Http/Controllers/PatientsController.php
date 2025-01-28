<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Tables\PatientsTable;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('patients.index', [
            'patients' => PatientsTable::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dni' => 'required|string|unique:patients|max:255', // Asegura que la cédula sea única
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gener' => 'required|in:Masculino,Femenino,Otro',
            'direction' => 'required',
            'telephone' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
            'blood_group' => 'nullable|max:255',
            'allergies' => 'nullable',
            'diseases' => 'nullable',
            'emergency_contact_name' => 'nullable|max:255',
            'emergency_contact_telephone' => 'nullable|max:255',
        ]);

        $patient = Patients::create($validatedData);
        $patient->createUserAccount($patient->dni);
        
        Toast::title('Paciente creado exitosamente')
            ->autoDismiss(3);

        // Puedes usar to_route() si tienes el paquete 'protonemedia/inertiajs-tables-laravel-query-builder' instalado
        return to_route('patients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patients $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patients $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patients $patient)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:patients,dni,' . $patient->id,
            'birthdate' => 'required|date',
            'gener' => 'required|in:Masculino,Femenino,Otro',
            'direction' => 'required',
            'telephone' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
            'blood_group' => 'nullable|max:255',
            'allergies' => 'nullable',
            'diseases' => 'nullable',
            'emergency_contact_name' => 'nullable|max:255',
            'emergency_contact_telephone' => 'nullable|max:255',
        ]);

        $patient->update($validatedData);

        Toast::title('Paciente actualizado exitosamente')
            ->autoDismiss(3);

        return to_route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patients $patient)
    {
        $patient->delete();

        Toast::title('Paciente eliminado')
            ->autoDismiss(3);

        return to_route('patients.index');
    }
}

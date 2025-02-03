<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Histories;
use App\Models\Patients;
use App\Tables\HistoriesTable;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class HistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('histories.index', [
            'histories' => HistoriesTable::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patients::all();
        $doctors = Doctors::all();

        return view('histories.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'entry_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Crear la cita
        Histories::create($validatedData);

        Toast::title('Historia creada exitosamente')->autoDismiss(3);

        return to_route('histories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Histories $history)
    {
        return view('histories.show', compact('history'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Histories $history)
    {
        $patients = Patients::all();
        $doctors = Doctors::all();

        return view('histories.edit', compact('patients', 'doctors', 'history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Histories $history)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'entry_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $history->update($validatedData);

        Toast::title('Historia actualizada correctamente')->autoDismiss(3);

        return to_route('histories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Histories $history)
    {
        $history->delete();

        Toast::title('Historia eliminada correctamente')
            ->autoDismiss(3);

        return to_route('histories.index');
    }
}

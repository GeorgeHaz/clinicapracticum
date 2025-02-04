<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\Specialties;
use Illuminate\Http\Request;
use App\Tables\AppointmentsTable;
use ProtoneMedia\Splade\Facades\Toast;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('appointments.index', [
            'appointments' => AppointmentsTable::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create appointment')) {
            abort(403, 'Acceso no autorizado.');
        }
        $patients = Patients::all();
        $specialties = Specialties::all();
        $doctors = Doctors::all();

        return view('appointments.create', compact('patients', 'doctors', 'specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patients_id' => 'required|exists:patients,id',
            'doctors_id' => 'required|exists:doctors,id',
            'specialties_id' => 'required|exists:specialties,id',
            'appointments_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:Agendada,Confirmada,Cancelada,Realizada',
            'observations' => 'nullable|string',
        ]);

        // Crear la cita
        Appointments::create($validatedData);

        Toast::title('Cita creada exitosamente')->autoDismiss(3);

        return to_route('appointments.index');
    }

    // En AppointmentController

    /**
     * Display the specified resource.
     */
    public function show(Appointments $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointments $appointment)
    {
        $patients = Patients::all();
        $specialties = Specialties::all();
        $doctors = Doctors::all();

        return view('appointments.edit', compact('patients', 'doctors', 'specialties', 'appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointments $appointment)
    {
        $validatedData = $request->validate([
            'patients_id' => 'required|exists:patients,id',
            'doctors_id' => 'required|exists:doctors,id',
            'specialties_id' => 'required|exists:specialties,id',
            'appointments_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:Agendada,Confirmada,Cancelada,Realizada',
            'observations' => 'nullable|string',
        ]);

        $existingAppointment = Appointments::where('id', '!=', $appointment->id) // Excluir la cita actual
            ->where('patients_id', $validatedData['patients_id'])
            ->where('appointments_date', $validatedData['appointments_date'])
            ->where(function ($query) use ($validatedData) {
                $query->where(function ($q) use ($validatedData) {
                    $q->where('start_time', '<', $validatedData['end_time'])
                        ->where('end_time', '>', $validatedData['start_time']);
                })->orWhere(function ($q) use ($validatedData) {
                    $q->where('start_time', '>=', $validatedData['start_time'])
                        ->where('start_time', '<', $validatedData['end_time']);
                });
            })
            ->first();

        if ($existingAppointment) {
            Toast::warning('La nueva hora se superpone con otra cita programada para este médico.')->autoDismiss(5);
            return redirect()->back();
        }

        $appointment->update($validatedData);

        Toast::title('Cita actualizada correctamente')->autoDismiss(3);

        return to_route('appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $appointment)
    {
        $appointment->delete();

        Toast::title('Cita eliminada correctamente')
            ->autoDismiss(3);

        return to_route('appointments.index');
    }
}

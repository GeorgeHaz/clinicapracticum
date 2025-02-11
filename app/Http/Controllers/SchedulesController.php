<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Models\Doctors;
use App\Models\Schedules;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('schedules.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctors::all();
        return view('schedules.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        $validatedData = $request->validated();
        // Verificar si ya existe un horario para el mismo doctor, día y rango de horas
        $existingSchedule = Schedules::where('doctor_id', $validatedData['doctor_id'])
            ->where('day_of_week', $validatedData['day_of_week'])
            ->where(function ($query) use ($validatedData) {
                $query->where(function ($q) use ($validatedData) {
                    $q->where('start_time', '<', $validatedData['end_time'])
                        ->where('end_time', '>', $validatedData['start_time']);
                })
                    ->orWhere(function ($q) use ($validatedData) {
                        $q->where('start_time', '>=', $validatedData['start_time'])
                            ->where('start_time', '<', $validatedData['end_time']);
                    });
            })
            ->first();

        if ($existingSchedule) {
            Toast::warning('Ya existe un horario para este médico en ese día y rango de horas.')->autoDismiss(7);
            return redirect()->back()->withInput(); // Redirigir de vuelta al formulario con los datos y errores.
        }

        // Si no hay conflictos, crear el nuevo horario.
        Schedules::create($validatedData);

        Toast::title('Horario creado exitosamente!')->autoDismiss(5);
        return to_route('schedules.index'); // Redirigir a la lista de horarios (o donde corresponda)

    }

    /**
     * Display the specified resource.
     */
    public function show(Schedules $schedules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedules $schedules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedules $schedules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedules $schedules)
    {
        //
    }
}

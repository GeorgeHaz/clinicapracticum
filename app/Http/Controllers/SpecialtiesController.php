<?php

namespace App\Http\Controllers;

use App\Models\Specialties;
use Illuminate\Http\Request;
use App\Tables\SpecialtiesTable;
use ProtoneMedia\Splade\Facades\Toast;

class SpecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('specialties.index', [
            'specialties' => SpecialtiesTable::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('specialties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $specialty = Specialties::create($validatedData);
        Toast::title('Especialidad creada exitosamente')
            ->autoDismiss(3);

        return to_route('specialties.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialties $specialty)
    {
        return view('specialties.show', compact('specialty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialties $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialties $specialty)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $specialty->update($validatedData);

        Toast::title('Especialidad actualizada exitosamente')
            ->autoDismiss(3);

        return to_route('specialties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialties $specialty)
    {
        $specialty->delete();

        Toast::title('Especialidad eliminado')
            ->autoDismiss(3);

        return to_route('specialties.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Secretaries;
use App\Tables\SecretariesTable;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class SecretariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('secretaries.index', [
            'secretaries' => SecretariesTable::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('secretaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|unique:secretaries|max:255', // Asegura que la cédula sea única
            'direction' => 'required',
            'telephone' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
        ]);

        $secretary = Secretaries::create($validatedData);
        $secretary->createUserAccount($secretary->dni);
        
        Toast::title('Secretaria creada exitosamente')
            ->autoDismiss(3);

        // Puedes usar to_route() si tienes el paquete 'protonemedia/inertiajs-tables-laravel-query-builder' instalado
        return to_route('secretaries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Secretaries $secretary)
    {
        return view('secretaries.show', compact('secretary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Secretaries $secretary)
    {
        return view('secretaries.edit', compact('secretary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Secretaries $secretary)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:patients,dni,' . $secretary->id,
            'direction' => 'required',
            'telephone' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
        ]);

        $secretary->update($validatedData);

        Toast::title('Secretaria actualizada exitosamente')
            ->autoDismiss(3);

        return to_route('secretaries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secretaries $secretary)
    {
        $secretary->delete();

        Toast::title('Secretaria eliminado')
            ->autoDismiss(3);

        return to_route('secretaries.index');
    }
}

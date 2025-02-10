<?php

namespace App\Tables;

use App\Models\Patients;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;

class PatientsTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Patients::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
        ->withGlobalSearch(columns: ['name','dni'])
        ->defaultSort('name')
        ->column('name','Nombre', sortable: true, searchable:true, canBeHidden: false)
        ->column('last_name','Apellido')
        ->column('address','Direccion')
        ->column('email','Correo')
        ->column('actions', 'Acciones')
        ->paginate()
        ->export('Exportar Pacientes','listado_pacientes.xlsx')
        ->perPageOptions([10,20,50])
        ->bulkAction(
            label: 'Eliminar seleccion',
            each: fn (Patients $patient) => $patient->delete(),
            confirm: 'Esta seguro que desea eliminar?',
            confirmButton: 'Si, Eliminar los seleccionados!',
            cancelButton: 'No, No eliminarlos!',
            after: fn () => Toast::title('Pacientes aliminados')
                ->autoDismiss(3)
        );
        

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}

<?php

namespace App\Tables;

use App\Models\Doctors;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class DoctorsTable extends AbstractTable
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
        return Doctors::query();
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
            ->withGlobalSearch(columns: ['id'])
            ->column('id', sortable: true)
            ->column('name', 'Nombre', sortable: true)
            ->column('last_name', 'Apellido')
            ->column('email', 'Correo')
            ->column('specialty.name', 'Especialidad')
            ->column('direction', 'Direccion')
            ->column('telephone', 'Telefono')
            ->column('actions', 'Acciones')
            ->paginate()
            ->export('Exportar Pacientes', 'listado_pacientes.xlsx')
            ->perPageOptions([10, 20, 50]);

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}

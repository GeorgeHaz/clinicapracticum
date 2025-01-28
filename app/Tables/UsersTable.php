<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class UsersTable extends AbstractTable
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
        return User::query();
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
            ->withGlobalSearch(columns: ['dni','name','last_name'])
            ->column('dni','Cedula', sortable: true)
            ->column('name','Nombre', sortable: true)
            ->column('last_name','Apellido')
            ->column('user','Usuario')
            ->column('rol','Rol')
            ->column('email','Correo')
            ->column('actions', 'Acciones')
            ->paginate()
            ->export('Exportar Usuarios','listado_usuarios.xlsx')
            ->perPageOptions([10,20,50])
            ->bulkAction(
                label: 'Eliminar seleccion',
                each: fn (Patients $patient) => $patient->delete(),
                confirm: 'Esta seguro que desea eliminar?',
                confirmButton: 'Si, Eliminar los seleccionados!',
                cancelButton: 'No, No eliminarlos!',
                after: fn () => Toast::title('Usuarios aliminados')
                    ->autoDismiss(3)
            );

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}

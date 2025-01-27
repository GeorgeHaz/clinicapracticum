<?php

namespace App\Tables;

use App\Models\Histories;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class HistoriesTable extends AbstractTable
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
        return Histories::query();
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
            ->column('patient.name', 'Paciente', sortable: true)
            ->column('doctor.name', 'Doctor', sortable: true)
            ->column('entry_date', 'Fecha', sortable: true)
            ->column('description', 'Descripccion', sortable: true)
            ->paginate()
            ->export('Exportar historia', 'listado_historia.xlsx')
            ->perPageOptions([10, 20, 50])
            ->column('actions', 'Acciones');;

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}

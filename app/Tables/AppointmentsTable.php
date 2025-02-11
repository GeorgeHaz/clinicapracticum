<?php

namespace App\Tables;

use App\Models\Appointments;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class AppointmentsTable extends AbstractTable
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
        return Appointments::query();
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
            ->withGlobalSearch(columns: ['patient.name','doctor.name'])
            ->column('patient.name','Paciente', sortable: true, searchable:true)
            ->column('doctor.name','Medico', sortable: true)
            ->column('specialty.name','Especialidad')
            ->column('appointments_date','Fecha de Cita')
            ->column('start_time','Hora Inicio')
            ->column('end_time','Hora Fin')
            ->column('status','Estado')
            ->column('observations','Observaciones')
            ->column('actions', 'Acciones');

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}

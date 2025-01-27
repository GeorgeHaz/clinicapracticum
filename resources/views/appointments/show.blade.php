<x-splade-modal>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-2 gap-4 flex">
                    <div>
                        <p><strong>{{ __('Paciente') }}:</strong> {{ $appointment->patient->name }} {{
                            $appointment->patient->last_name }}</p>
                        <p><strong>{{ __('Médico') }}:</strong> {{ $appointment->doctor->name }} {{
                            $appointment->doctor->last_name }}</p>
                        <p><strong>{{ __('Especialidad') }}:</strong> {{ $appointment->specialty->name }}</p>
                        <p><strong>{{ __('Estado') }}:</strong>
                            @if ($appointment->status == 'Agendada')
                            {{ __('Agendada') }}
                            @elseif ($appointment->status == 'Confirmada')
                            {{ __('Confirmada') }}
                            @elseif ($appointment->status == 'Cancelada')
                            {{ __('Cancelada') }}
                            @elseif ($appointment->status == 'Realizada')
                            {{ __('Completada') }}
                            @endif
                        </p>
                        <p><strong>{{ __('Observaciones') }}:</strong> {{ $appointment->observations ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p><strong>{{ __('Fecha') }}:</strong> {{ $appointment->appointments_date }}</p>
                        <p><strong>{{ __('Hora de Inicio') }}:</strong> {{ $appointment->start_time }}
                        </p>
                        <p><strong>{{ __('Hora de Fin') }}:</strong> {{ $appointment->end_time }}</p>
                    </div>
                </div>

                <x-splade-link href="{{ route('appointments.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Volver a la lista') }}
                </x-splade-link>
            </div>
        </div>
    </div>
</x-splade-modal>
<x-splade-modal>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Historia clinica') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-2 gap-4 flex">
                    <div>
                        <p><strong>{{ __('Paciente') }}:</strong> {{ $history->patient->name }} {{
                            $history->patient->last_name }}</p>
                        <p><strong>{{ __('Descripcion') }}:</strong> {{ $history->description ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p><strong>{{ __('Médico') }}:</strong> {{ $history->doctor->name }} {{
                            $history->doctor->last_name }}</p>
                        <p><strong>{{ __('Fecha') }}:</strong> {{ $history->entry_date }}</p>
                    </div>
                </div>

                <x-splade-link href="{{ route('appointments.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Volver a la lista') }}
                </x-splade-link>
            </div>
        </div>
    </div>
</x-splade-modal>
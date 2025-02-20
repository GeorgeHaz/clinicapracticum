<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Citas') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" flex items-center justify-end">
                <Link modal href="{{ route('appointments.create') }}" title="Agendar Cita" class="inline-flex rounded-md shadow-sm bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline">
                    Agendar Cita
                </Link>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-table :for="$appointments">
                        <x-slot:empty-state>
                            <p>No hay Citas Registradas! </p>
                        </x-slot:empty-state>
                        <x-splade-cell actions as="$appointment">
                            <Link 
                                modal 
                                href="{{ route('appointments.show', $appointment->id) }}" 
                                class="bg-yellow-500 hover:bg-yellow-700 flex px-4 py-2 rounded mr-2" 
                                title="Ver"> 
                                <x-show-icon class="w-5 h-5" /> 
                            </Link>
                            <Link 
                                modal 
                                href="{{ route('appointments.edit', $appointment->id) }}" 
                                class="bg-blue-500 hover:bg-blue-700 flex px-4 py-2 rounded" 
                                title="Editar">
                            <x-pencil-icon class="w-5 h-5" />
                            </Link>
                            <x-splade-form action="{{ route('appointments.destroy', $appointment) }}" class="flex px-2" title="Eliminar" method="DELETE" confirm>
                                <x-splade-submit danger>
                                    <x-trash-icon class="w-5 h-5" />
                                </x-splade-submit>
                            </x-splade-form>
                        </x-splade-cell>
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
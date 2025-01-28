<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Si es primera vez, actualice su contrasena en la esquina superior derecha donde refleja su nombre.
                    Su contrasena actual es su numero de cedula.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

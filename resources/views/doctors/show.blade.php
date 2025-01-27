<x-splade-modal>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Medico') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-2">
                    {{ $doctor->name }} {{ $doctor->last_name }}
                </h3>
                <div class="grid grid-cols-2 gap-4 mb-6">

                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="specialty">
                            {{ __('Especialidad') }}
                        </label>
                        <p class="mt-1 text-sm text-gray-600">{{ $doctor->specialty->name }}</p>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="dni">
                            {{ __('Cédula') }}
                        </label>
                        <p class="mt-1 text-sm text-gray-600">{{ $doctor->dni }}</p>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="telephone">
                            {{ __('Teléfono') }}
                        </label>
                        <p class="mt-1 text-sm text-gray-600">{{ $doctor->telephone }}</p>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="direction">
                            {{ __('Dirección') }}
                        </label>
                        <p class="mt-1 text-sm text-gray-600">{{ $doctor->direction }}</p>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="email">
                            {{ __('Correo Electrónico') }}
                        </label>
                        <p class="mt-1 text-sm text-gray-600">{{ $doctor->email }}</p>
                    </div>

                    </div>
                <x-splade-link href="{{ route('doctors.index') }}"
                    class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Volver a la lista') }}
                </x-splade-link>
            </div>
        </div>
    </div>
</x-splade-modal>
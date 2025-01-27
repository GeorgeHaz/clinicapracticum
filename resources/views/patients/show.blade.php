<x-splade-modal>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    {{ $patient->name }} {{ $patient->last_name }}
                </h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>{{ __('Cédula') }}:</strong> {{ $patient->dni }}</p>
                        <p><strong>{{ __('Fecha de Nacimiento') }}:</strong> {{ $patient->birthdate }}</p>
                        <p><strong>{{ __('Género') }}:</strong> {{ $patient->gener }}</p>
                        <p><strong>{{ __('Dirección') }}:</strong> {{ $patient->direction }}</p>
                        <p><strong>{{ __('Teléfono') }}:</strong> {{ $patient->telephone }}</p>
                        <p><strong>{{ __('Correo Electrónico') }}:</strong> {{ $patient->email ?? 'N/A' }}</p>
                        <p><strong>{{ __('Grupo Sanguíneo') }}:</strong> {{ $patient->blood_group ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p><strong>{{ __('Alergias') }}:</strong> {{ $patient->allergies ?? 'N/A' }}</p>
                        <p><strong>{{ __('Enfermedades Crónicas') }}:</strong> {{ $patient->diseases ?? 'N/A' }}</p>
                        <p><strong>{{ __('Nombre Contacto Emergencia') }}:</strong> {{ $patient->emergency_contact_name ?? 'N/A' }}</p>
                        <p><strong>{{ __('Teléfono Contacto Emergencia') }}:</strong> {{ $patient->emergency_contact_phone ?? 'N/A' }}</p>
                    </div>
                </div>
                <Link href="{{ route('patients.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{__('Volver a la lista')}}
                </Link>
            </div>
        </div>
    </div>
</x-splade-modal>
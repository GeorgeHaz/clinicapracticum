<x-splade-modal>
    <x-slot name="title">
        {{ __('Crear Historia') }}
    </x-slot>

    <x-splade-form :action="route('histories.store')">

        <x-splade-select name="patient_id" :label="__('Paciente')">
            <option value="" disabled selected>{{ __('Seleccione un paciente') }}</option>
            @foreach ($patients as $patient)
            <option value="{{ $patient->id }}">{{ $patient->name }} {{ $patient->last_name }}</option>
            @endforeach
        </x-splade-select>
        <x-splade-select name="doctor_id" :label="__('Médico')">
            <option value="" disabled selected>{{ __('Seleccione un médico') }}</option>
            @foreach ($doctors as $doctor)
            <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->last_name }} ({{ $doctor->specialty->name }})</option>
            @endforeach
        </x-splade-select>
        <x-splade-input type="date" name="entry_date" :label="__('Fecha de la Historia')" required />
        <x-splade-textarea name="description" :label="__('Descripcion')" />
        <x-splade-submit class="mt-4" :label="__('Crear Historia')" />

    </x-splade-form>
    <button @click="modal.close" class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Cerrar
    </button>
</x-splade-modal>
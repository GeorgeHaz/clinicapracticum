<x-splade-modal>
    <x-slot name="title">
        {{ __('Crear Cita') }}
    </x-slot>

    <x-splade-form :action="route('appointments.store')">
        <div class="grid grid-cols-2 gap-4 mb-4">

            <x-splade-select name="patients_id" :label="__('Paciente')">
                <option value="" disabled selected>{{ __('Seleccione un paciente') }}</option>
                @foreach ($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->name }} {{ $patient->last_name }}</option>
                @endforeach
            </x-splade-select>

            <x-splade-select name="specialties_id" :label="__('Especialidad')">
                <option value="" disabled selected>{{ __('Seleccione una especialidad') }}</option>
                @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
            </x-splade-select>

            <x-splade-select name="doctors_id" :label="__('Médico')">
                <option value="" disabled selected>{{ __('Seleccione un médico') }}</option>
                @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->last_name }} ({{ $doctor->specialty->name }})</option>
                @endforeach
            </x-splade-select>

            <x-splade-input date name="appointments_date" :label="__('Fecha de la cita')" required />
            <x-splade-input type="time" name="start_time" :label="__('Hora de inicio')" required />
            <x-splade-input type="time" name="end_time" :label="__('Hora de fin')" required />

            <x-splade-select name="status" :label="__('Estado')">
                <option value="Agendada">{{ __('Agendada') }}</option>
                <option value="Confirmada">{{ __('Confirmada') }}</option>
                <option value="Cancelada">{{ __('Cancelada') }}</option>
                <option value="Realizada">{{ __('Realizada') }}</option>
            </x-splade-select>

            <x-splade-textarea name="observations" :label="__('Observaciones')" />
        </div>

        <x-splade-submit class="mt-4" :label="__('Crear Cita')" />

    </x-splade-form>
    <button @click="modal.close" class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Cerrar
    </button>
</x-splade-modal>
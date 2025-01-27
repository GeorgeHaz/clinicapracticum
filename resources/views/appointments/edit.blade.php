<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Editar Cita') }}
    </h2>

    <x-splade-form :default="$appointment" :action="route('appointments.update', $appointment)" method="patch">
        <x-splade-select name="patients_id" :label="__('Paciente')">
            <option value="" disabled>{{ __('Seleccione un paciente') }}</option>
            @foreach ($patients as $patient)
            <option value="{{ $patient->id }}" @selected(old('patients_id', $appointment->patients_id) == $patient->id)>
                {{ $patient->name }} {{ $patient->last_name }}
            </option>
            @endforeach
        </x-splade-select>

        <x-splade-select name="specialties_id" :label="__('Especialidad')">
            <option value="" disabled selected>{{ __('Seleccione una especialidad') }}</option>
            @foreach ($specialties as $specialty)
            <option value="{{ $specialty->id }}" @selected(old('specialties_id', $appointment->specialties_id) == $specialty->id)>
                {{ $specialty->name }}
            </option>
            @endforeach
        </x-splade-select>

        <x-splade-select name="doctors_id" :label="__('Médico')">
            <option value="" disabled>{{ __('Seleccione un médico') }}</option>
            @foreach ($doctors as $doctor)
            <option value="{{ $doctor->id }}" @selected(old('doctors_id', $appointment->doctors_id) == $doctor->id)>
                {{ $doctor->name }} {{ $doctor->last_name }}
            </option>
            @endforeach
        </x-splade-select>

        <x-splade-input type="date" name="appointments_date" :label="__('Fecha de la cita')" required />
        <x-splade-input type="time" name="start_time" :label="__('Hora de inicio')" required />
        <x-splade-input type="time" name="end_time" :label="__('Hora de fin')" required />

        <x-splade-select name="status" :label="__('Estado')">
            <option value="Agendada" @selected(old('status', $appointment->status) == 'Agendada')>{{ __('Agendada') }}</option>
            <option value="Confirmada" @selected(old('status', $appointment->status) == 'Confirmada')>{{ __('Confirmada') }}</option>
            <option value="Cancelada" @selected(old('status', $appointment->status) == 'Cancelada')>{{ __('Cancelada') }}</option>
            <option value="Realizada" @selected(old('status', $appointment->status) == 'Realizada')>{{ __('Realizada') }}</option>
        </x-splade-select>

        <x-splade-textarea name="observations" :label="__('Observaciones')" />

        <x-splade-submit class="mt-4" :label="__('Actualizar Cita')" />
    </x-splade-form>
    <button @click="modal.close" class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Cerrar
    </button>
</x-splade-modal>
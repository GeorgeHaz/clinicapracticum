<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Horarios') }}
        </h2>
    </x-slot>

    <x-splade-select name="doctors_id" :label="__('Médico')">
        <option value="" disabled selected>{{ __('Seleccione un médico') }}</option>
        @foreach ($doctors as $doctor)
        <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->last_name }} ({{ $doctor->specialty->name }})</option>
        @endforeach
    </x-splade-select>

    <x-splade-input type="date" name="appointment_date" :label="__('Fecha')" />

    <x-splade-select name="start_time" :label="__('Hora')">
        {{-- Aquí se mostrarían las opciones de hora, generadas dinámicamente --}}
        @foreach($availableTimeSlots as $timeSlot)
        <option value="{{ $timeSlot }}">{{ $timeSlot }}</option>
        @endforeach
    </x-splade-select>
</x-app-layout>
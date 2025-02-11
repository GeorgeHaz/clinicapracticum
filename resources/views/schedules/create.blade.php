<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Register New Schedules') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Choose your available business hours.") }}
        </p>
    </header>

    <x-splade-modal>
        <x-splade-form :action="route('schedules.store')">
            <div class="grid grid-cols-2 gap-4 mb-4">

                <x-splade-select name="doctor_id" :label="__('Médico')" required>
                    <option value="" disabled selected>{{ __('Seleccione un médico') }}</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->last_name }} ({{
                        $doctor->specialty->name }})</option>
                    @endforeach
                </x-splade-select>

                <x-splade-select name="day_of_week" :label="__('Día de la semana')" required>
                    <option value="" disabled selected>{{ __('Seleccione un día') }}</option>
                    <option value="Lunes">{{ __('Lunes') }}</option>
                    <option value="Martes">{{ __('Martes') }}</option>
                    <option value="Miércoles">{{ __('Miércoles') }}</option>
                    <option value="Jueves">{{ __('Jueves') }}</option>
                    <option value="Viernes">{{ __('Viernes') }}</option>
                    <option value="Sábado">{{ __('Sábado') }}</option>
                    <option value="Domingo">{{ __('Domingo') }}</option>
                </x-splade-select>

                <x-splade-input type="time" name="start_time" :label="__('Hora de inicio')" required />
                <x-splade-input type="time" name="end_time" :label="__('Hora de fin')" required />

                <x-splade-input type="number" name="interval" :label="__('Intervalo (minutos)')" required :min="15"
                    :max="120" :default="30" />

                <x-splade-checkbox name="active" :label="__('Activo')" :value="1" :checked="true" />
            </div>

            <x-splade-submit class="mt-4" :label="__('Crear Horario')" />
        </x-splade-form>
    </x-splade-modal>
</section>
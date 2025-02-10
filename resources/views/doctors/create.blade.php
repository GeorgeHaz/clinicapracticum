<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Registrar Medico') }}
    </h2>

    <x-splade-form :action="route('doctors.store')" class="mt-6 space-y-6">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <x-splade-input id="dni" name="dni" type="text" :label="__('Cedula')" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" autofocus />
            <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
            <x-splade-input id="last_name" name="last_name" type="text" :label="__('Apellido')" required />
            <x-splade-select name="specialties_id" :label="__('Especialidad')" required>
                <option value="" disabled selected>{{ __('Seleccione una especialidad') }}</option>
                @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
            </x-splade-select>
            <x-splade-input id="email" name="email" type="email" :label="__('Correo')" required autofocus />
            <x-splade-input id="address" name="address" type="text" :label="__('Direccion')" />
            <x-splade-input id="phone" name="phone" type="text" :label="__('Telefono')" />
        </div>
        <div class="flex items-center justify-end">
            <x-splade-submit :label="__('Crear')" />
        </div>
    </x-splade-form>
</x-splade-modal>
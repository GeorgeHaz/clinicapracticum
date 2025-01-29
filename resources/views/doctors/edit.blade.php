<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Información del Doctor') }}
    </h2>
    <x-splade-form :default="$doctor" :action="route('doctors.update', $doctor)" method="patch" class="mt-6 space-y-6">

        <x-splade-input id="dni" name="dni" type="text" :label="__('Cedula')" required autofocus/>
        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="last_name" name="last_name" type="text" :label="__('Apellido')" required />
        <x-splade-select name="specialties_id" :label="__('Especialidad')">
            <option value="" disabled selected>{{ __('Seleccione una especialidad') }}</option>
            @foreach ($specialties as $specialty)
            <option value="{{ $specialty->id }}" @selected(old('specialties_id', $doctor->specialties_id) == $specialty->id)>
                {{ $specialty->name }}
            </option>
            @endforeach
        </x-splade-select>
        <x-splade-input id="address" name="address" type="text" :label="__('Direccion')" required />
        <x-splade-input id="phone" name="phone" type="text" :label="__('Telefono')" required />
        <x-splade-input id="email" name="email" type="email" :label="__('Correo')" />
        <div class="flex items-center justify-end">
            <x-splade-submit class="ml-4" :label="__('Actualizar')" />
        </div>
    </x-splade-form>
</x-splade-modal>
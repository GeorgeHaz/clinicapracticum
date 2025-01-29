<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Registrar Secretaria') }}
    </h2>

    <x-splade-form :action="route('secretaries.store')" class="mt-6 space-y-6">
        <x-splade-input id="dni" name="dni" type="text" :label="__('Cedula')" required autofocus maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required />
        <x-splade-input id="last_name" name="last_name" type="text" :label="__('Apellido')" required />
        <x-splade-input id="email" name="email" type="email" :label="__('Correo')" />
        <x-splade-input id="address" name="address" type="text" :label="__('Direccion')" />
        <x-splade-input id="phone" name="phone" type="text" :label="__('Telefono')"  />

        <div class="flex items-center justify-end">
            <x-splade-submit :label="__('Crear')" />
        </div>
    </x-splade-form>
</x-splade-modal>
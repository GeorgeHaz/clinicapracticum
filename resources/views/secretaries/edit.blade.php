<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Información de Secretria') }}
    </h2>
    <x-splade-form :default="$secretary" :action="route('secretaries.update', $secretary)" method="patch" class="mt-6 space-y-6">

        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="last_name" name="last_name" type="text" :label="__('Apellido')" required />
        <x-splade-input id="dni" name="dni" type="text" :label="__('Cedula')" required />
        <x-splade-input id="direction" name="direction" type="text" :label="__('Direccion')" required />
        <x-splade-input id="telephone" name="telephone" type="text" :label="__('Telefono')" required />
        <x-splade-input id="email" name="email" type="email" :label="__('Correo')" />
        <div class="flex items-center justify-end">
            <x-splade-submit class="ml-4" :label="__('Actualizar')" />
        </div>
    </x-splade-form>
</x-splade-modal>
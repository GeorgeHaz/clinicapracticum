<x-splade-modal>
    <x-slot name="title">
        {{ __('Crear Secretaria') }}
    </x-slot>

    <x-splade-form :action="route('secretaries.store')" class="mt-6 space-y-6">
        <x-splade-input id="dni" name="dni" type="text" :label="__('Cedula')" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="last_name" name="last_name" type="text" :label="__('Apellido')" required />
        <x-splade-input id="direction" name="direction" type="text" :label="__('Direccion')" required />
        <x-splade-input id="telephone" name="telephone" type="text" :label="__('Telefono')" required />
        <x-splade-input id="email" name="email" type="email" :label="__('Correo')" />

        <div class="flex items-center justify-end">
            <x-splade-submit :label="__('Crear')" />
        </div>
    </x-splade-form>
</x-splade-modal>
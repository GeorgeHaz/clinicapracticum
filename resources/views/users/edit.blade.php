<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Información del Usuario') }}
    </h2>
    <x-splade-form :default="$user" :action="route('users.update', $user)" method="patch" class="mt-6 space-y-6">

        <x-splade-input id="dni" name="dni" type="text" :label="__('Cedula')" required autofocus />
        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="last_name" name="last_name" type="text" :label="__('Apellido')" required />
        <x-splade-input id="user" name="user" type="text" :label="__('Usuario')" required />
        <x-splade-select id="rol" type="text" name="rol" :label="__('Rol')" required autofocus>
            <option value="Medico">Medico</option>
            <option value="Secretaria">Secretaria</option>
            <option value="Administrador">Administrador</option>
            <option value="Paciente">Paciente</option>
        </x-splade-select>

        <div class="flex items-center justify-end">
            <x-splade-submit class="ml-4" :label="__('Actualizar')" />
        </div>
    </x-splade-form>
</x-splade-modal>
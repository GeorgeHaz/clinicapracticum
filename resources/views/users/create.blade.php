<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Crear Usuario') }}
    </h2>
    <x-splade-form :action="route('users.store')" class="space-y-4">
            <x-splade-input id="name" type="text" name="name" :label="__('Name')" required autofocus />
            <x-splade-input id="user" type="text" name="user" :label="__('Usuario')" required autofocus />
            <x-splade-input id="email" type="email" name="email" :label="__('Correo')" required />
            <x-splade-select id="role" type="text" name="role" :label="__('Rol')" required autofocus>
                <option value="Medico">Medico</option>
                <option value="Secretaria">Secretaria</option>
                <option value="Administrador">Administrador</option>
            </x-splade-select>
            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="new-password" />
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" required />

        <div class="flex items-center justify-end">
            <x-splade-submit class="ml-4" :label="__('Registrar')" />
        </div>
    </x-splade-form>
</x-splade-modal>
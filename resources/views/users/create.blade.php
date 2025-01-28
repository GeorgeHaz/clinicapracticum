<x-splade-modal>
        <x-splade-form action="{{ route('users.create') }}" class="space-y-4">
            <x-splade-input 
                    id="dni" 
                    type="text" 
                    name="dni" 
                    :label="__('Cedula')" 
                    required autofocus
                    maxlength="10" 
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"

            />
            <x-splade-input id="name" type="text" name="name" :label="__('Name')" required autofocus />
            <x-splade-input id="last_name" type="text" name="last_name" :label="__('Apellido')" required autofocus />
            <x-splade-input id="user" type="text" name="user" :label="__('Usuario')" required autofocus />
            <x-splade-input id="email" type="email" name="email" :label="__('Correo')" required />
            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="new-password" />
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" required />

            <div class="flex items-center justify-end">
                <x-splade-submit class="ml-4" :label="__('Registrar')" />
            </div>
        </x-splade-form>
</x-splade-modal>
<x-guest-layout>
    <x-auth-card>
        <x-splade-form action="{{ route('register') }}" class="space-y-4">
            <x-splade-input id="name" type="text" name="name" :label="__('Name')" required autofocus />
            <x-splade-input id="user" type="text" name="user" :label="__('Usuario')" required autofocus />
            <x-splade-input id="email" type="email" name="email" :label="__('Correo')" required />
            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="new-password" />
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" required />

            <div class="flex items-center justify-end">
                <Link class="underline text-sm text-gray-600 hover:text-gray-900 ml-4" href="{{ route('login') }}">
                    {{ __('Ya se encuentra registrado?') }}
                </Link>

                <x-splade-submit class="ml-4" :label="__('Registrar')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
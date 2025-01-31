<x-splade-modal>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    {{ $user->name }} {{ $user->last_name }}
                </h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>{{ __('User') }}:</strong> {{ $user->user }}</p>
                        <p><strong>{{ __('Rol') }}:</strong> {{ $user->role }}</p>
                    </div>
                    <div>
                    <p><strong>{{ __('Correo Electrónico') }}:</strong> {{ $user->email ?? 'N/A' }}</p>
                    </div>
                </div>
                <Link href="{{ route('users.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{__('Volver a la lista')}}
                </Link>
            </div>
        </div>
    </div>
</x-splade-modal>
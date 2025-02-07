<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" flex items-center justify-end">
                <Link modal href="{{ route('users.create') }}" title="Crear Usuario" class="inline-flex rounded-md shadow-sm bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 mb-3 focus:outline-none focus:shadow-outline">
                Registrar Usuario
                </Link>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-table :for="$user">
                        @php
                        $isSecretaria = auth()->user()->hasRole('Secretaria');
                        @endphp
                        <x-slot:empty-state>
                            <p>{{ $isSecretaria ? 'No hay pendientes de aprobación.' : 'No hay usuarios registrados.' }}</p>
                        </x-slot:empty-state>
                        <x-splade-cell actions as="$user">
                            @if(auth()->user()->hasRole(['Administrador']))
                            <Link modal href="{{ route('users.show', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-700 flex px-4 py-2 rounded mr-2" title="Ver">
                            <x-show-icon class="w-5 h-5" />
                            </Link>
                            <Link modal href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 flex px-4 py-2 rounded mr-2" title="Editar">
                            <x-pencil-icon class="w-5 h-5" />
                            </Link>
                            @endif
                            @if(auth()->user()->hasAnyRole(['Administrador','Secretaria']))
                            @if($user->hasRole('Invitado'))
                            <Link modal href="{{ route('users.promote', $user->id) }}" class="bg-green-500 hover:bg-green-700 flex px-4 py-2 rounded" title="Aprobar">
                            <x-approve-icon class="w-5 h-5" />
                            </Link>
                            @endif
                            @endif
                            <x-splade-form action="{{ route('users.destroy', $user) }}" class="flex px-2" title="Eliminar" method="DELETE" confirm>
                                <x-splade-submit danger>
                                    <x-trash-icon class="w-5 h-5" />
                                </x-splade-submit>
                            </x-splade-form>
                        </x-splade-cell>
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
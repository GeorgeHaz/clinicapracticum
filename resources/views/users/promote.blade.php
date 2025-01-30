<x-splade-modal>
    <x-slot name="title">
        {{ __('Promover a Paciente') }}
    </x-slot>

    <h2 class="text-lg font-medium text-gray-900 mb-6">
        {{ __('Confirme la promoción del usuario ') }} {{ $user->name }} {{ $user->last_name }} {{__(' a Paciente')}} 
    </h2>

    <x-splade-form :action="route('users.promoteStore', $user->id)" method="POST">

        <x-splade-submit class="mt-4" :label="__('Promover')" />

    </x-splade-form>
    <button @click="modal.close"
        class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Cerrar
    </button>
</x-splade-modal>
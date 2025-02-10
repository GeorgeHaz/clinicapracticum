<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Información del Usuario') }}
    </h2>
    <x-splade-form :default="$user" :action="route('users.update', $user)" method="patch" class="mt-6 space-y-6">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
            <x-splade-input id="user" name="user" type="text" :label="__('Usuario')" required />
        </div>
        <div class="flex items-center justify-end">
            <x-splade-submit class="ml-4" :label="__('Actualizar')" />
        </div>
    </x-splade-form>
    <button @click="modal.close()"
        class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Cerrar
    </button>
</x-splade-modal>
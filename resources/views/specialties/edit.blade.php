<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Actualizar Especialidades') }}
    </h2>
    <x-splade-form :default="$specialty" :action="route('specialties.update', $specialty)" method="patch" class="mt-6 space-y-6">

        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="description" name="description" type="text" :label="__('Descripcion')" required />
        
        <div class="flex items-center justify-end">
            <x-splade-submit class="ml-4" :label="__('Actualizar')" />
        </div>
    </x-splade-form>
</x-splade-modal>
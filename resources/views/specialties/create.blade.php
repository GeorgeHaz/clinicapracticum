<x-splade-modal>
    <x-slot name="title">
        {{ __('Crear Especialidad') }}
    </x-slot>

    <x-splade-form :action="route('specialties.store')" class="mt-6 space-y-6">
        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="description" name="description" type="text" :label="__('Descripcion')" />

        <div class="flex items-center justify-end">
            <x-splade-submit :label="__('Crear')" />
        </div>
    </x-splade-form>
</x-splade-modal>
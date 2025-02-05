<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Información del Usuario') }}
    </h2>
    <x-splade-form :default="$user" :action="route('users.update', $user)" method="patch" class="mt-6 space-y-6">

        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="user" name="user" type="text" :label="__('Usuario')" required />
        <x-splade-select 
            id="role" 
            name="role" 
            :label="__('Rol')" 
            :options="Spatie\Permission\Models\Role::pluck('name', 'name')->toArray()" 
            :value="old('role', optional($user->roles->first())->name)" 
            required 
        />
        <div class="flex items-center justify-end">
            <x-splade-submit class="ml-4" :label="__('Actualizar')" />
        </div>
    </x-splade-form>
</x-splade-modal>
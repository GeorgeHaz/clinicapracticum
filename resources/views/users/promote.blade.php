<x-splade-modal>
    <x-slot name="title">
        {{ __('Promover a Paciente') }}
    </x-slot>

    <h2 class="text-lg font-medium text-gray-900 mb-6">
        {{ __('Completar datos para el paciente: ') }} {{ $user->name }}
    </h2>

    <x-splade-form :action="route('users.promoteStore', $user->id)" method="POST" :default="$user">
        @method('PATCH')
        {{-- Usar PATCH para actualizar --}}

        <x-splade-input name="name" :label="__('Nombre')" required autofocus />
        <x-splade-input name="last_name" :label="__('Apellido')" required autofocus/>
        <x-splade-input id="dni" name="dni" type="text" :label="__('Cédula')" required
            maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" autofocus />
        <x-splade-input name="birthdate" type="date" :label="__('Fecha de Nacimiento')" required />
        <x-splade-select id="gender" name="gender" :label="__('Género')" required>
            <option value="" disabled>{{ __('Seleccione un género') }}</option>
            <option value="Masculino">{{ __('Masculino') }}</option>
            <option value="Femenino">{{ __('Femenino') }}</option>
        </x-splade-select>
        <x-splade-input name="address" :label="__('Dirección')" required />
        <x-splade-input name="phone" :label="__('Teléfono')" required />
        <x-splade-input type="email" name="email" :label="__('Correo Electrónico')" />
        <x-splade-select name="blood_group" :label="__('Tipo de sangre')">
          <option value="" selected disabled>{{__('Seleccione un tipo de sangre')}}</option>
            <option value="O-">O-</option>
            <option value="O+">O+</option>
            <option value="A-">A-</option>
            <option value="A+">A+</option>
            <option value="B-">B-</option>
            <option value="B+">B+</option>
            <option value="AB-">AB-</option>
            <option value="AB+">AB+</option>
        </x-splade-select>
        <x-splade-textarea name="allergies" :label="__('Alergias')" />
        <x-splade-textarea name="diseases" :label="__('Enfermedades Crónicas')" />
        <x-splade-input name="emergency_contact_name" :label="__('Nombre Contacto Emergencia')" />
        <x-splade-input name="emergency_contact_phone" :label="__('Teléfono Contacto Emergencia')" />

        <x-splade-submit class="mt-4" :label="__('Promover')" />
    </x-splade-form>
    <button @click="modal.close()"
        class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Cerrar
    </button>
</x-splade-modal>
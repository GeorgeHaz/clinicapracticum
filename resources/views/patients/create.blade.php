<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Crear Paciente') }}
    </h2>

    <x-splade-form :action="route('patients.store')" class="mt-6 space-y-6">
        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="last_name" name="last_name" type="text" :label="__('Apellido')" required autofocus/>
        <x-splade-input id="dni" name="dni" type="text" :label="__('Cedula')" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
        <x-splade-input id="birthdate" name="birthdate" type="date" :label="__('Fecha de nacimiento')" required />
        <x-splade-select id="gener" name="gener" :label="__('Genero')">
            <option value="Masculino">{{ __('Masculino') }}</option>
            <option value="Femenino">{{ __('Femenino') }}</option>
            <option value="Otro">{{ __('Otro') }}</option>
        </x-splade-select>
        <x-splade-input id="direction" name="direction" type="text" :label="__('Direccion')" required />
        <x-splade-input id="telephone" name="telephone" type="text" :label="__('Telefono')" required />
        <x-splade-input id="email" name="email" type="email" :label="__('Correo')" />
        <x-splade-select id="blood_group" name="blood_group" :label="__('Tipo de sangre')">
            <option value="O-">{{__('O-') }}</option>
            <option value="O+">{{__('O+') }}</option>
            <option value="A-">{{__('A-') }}</option>
            <option value="A+">{{__('A+') }}</option>
            <option value="B-">{{__('B-') }}</option>
            <option value="B+">{{__('B+') }}</option>
            <option value="AB-">{{__('AB-') }}</option>
            <option value="AB+">{{__('AB+') }}</option>
        </x-splade-select>
        <x-splade-textarea id="allergies" name="allergies" :label="__('Alergias')" />
        <x-splade-textarea id="diseases" name="diseases" :label="__('Enfermedades')" />
        <x-splade-input id="emergency_contact_name" name="emergency_contact_name" type="text" :label="__('Nombre del contacto de emergencia')" />
        <x-splade-input id="emergency_contact_telephone" name="emergency_contact_telephone" type="text" :label="__('Numero del contacto de emergencia')" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

        <div class="flex items-center justify-end">
            <x-splade-submit :label="__('Crear')" />
        </div>
    </x-splade-form>
</x-splade-modal>
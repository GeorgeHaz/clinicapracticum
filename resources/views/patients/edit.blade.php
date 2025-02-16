<x-splade-modal>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Información del Paciente') }}
    </h2>
    <x-splade-form :default="$patient" :action="route('patients.update', $patient)" method="patch" class="mt-6 space-y-6">

        <x-splade-input id="name" name="name" type="text" :label="__('Nombre')" required autofocus />
        <x-splade-input id="last_name" name="last_name" type="text" :label="__('Apellido')" required />
        <x-splade-input id="dni" name="dni" type="text" :label="__('Cedula')" required />
        <x-splade-input id="birthdate" name="birthdate" type="date" :label="__('Fecha de nacimiento')" required />
        <x-splade-select id="gener" name="gener" :label="__('Genero')">
            <option value="Masculino" @selected(old('gener', $patient->gener) == 'Masculino')>Masculino</option>
            <option value="Femenino" @selected(old('gener', $patient->gener) == 'Femenino')>Femenino</option>
            <option value="Otro" @selected(old('gener', $patient->gener) == 'Otro')>Otro</option>
        </x-splade-select>
        <x-splade-input id="direction" name="direction" type="text" :label="__('Direccion')" required />
        <x-splade-input id="telephone" name="telephone" type="text" :label="__('Telefono')" required />
        <x-splade-input id="email" name="email" type="email" :label="__('Correo')" />
        <x-splade-select id="blood_group" name="blood_group" :label="__('Tipo de sangre')">
            <option value="O-" @selected(old('blood_group', $patient->blood_group) == 'O-')>O-</option>
            <option value="O+" @selected(old('blood_group', $patient->blood_group) == 'O+')>O+</option>
            <option value="A-" @selected(old('blood_group', $patient->blood_group) == 'A-')>A-</option>
            <option value="A+" @selected(old('blood_group', $patient->blood_group) == 'A+')>A+</option>
            <option value="B-" @selected(old('blood_group', $patient->blood_group) == 'B-')>B-</option>
            <option value="B+" @selected(old('blood_group', $patient->blood_group) == 'B+')>B+</option>
            <option value="AB-" @selected(old('blood_group', $patient->blood_group) == 'AB-')>AB-</option>
            <option value="AB+" @selected(old('blood_group', $patient->blood_group) == 'AB+')>AB+</option>
        </x-splade-select>
        <x-splade-textarea id="allergies" name="allergies" :label="__('Alergias')" />
        <x-splade-textarea id="diseases" name="diseases" :label="__('Enfermedades')" />
        <x-splade-input id="emergency_contact_name" name="emergency_contact_name" type="text" :label="__('Nombre del contacto de emergencia')" />
        <x-splade-input id="emergency_contact_telephone" name="emergency_contact_telephone" type="text" :label="__('Numero del contacto de emergencia')" />

        <div class="flex items-center justify-end">
            <x-splade-submit class="ml-4" :label="__('Actualizar')" />
        </div>
    </x-splade-form>
</x-splade-modal>
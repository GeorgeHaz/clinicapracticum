<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $entities = ['appointments','patients','users','specialties','doctors','secretaries','histories'];

        // Crear permisos
        foreach($entities as $entity){
            Permission::create(['name' => "{$entity}.create"]);
            Permission::create(['name' => "{$entity}.edit"]);
            Permission::create(['name' => "{$entity}.index"]);
            Permission::create(['name' => "{$entity}.show"]);
            Permission::create(['name' => "{$entity}.delete"]);
        }

        Permission::create(['name' => 'approve users']);

        // Crear roles y asignar permisos
        $adminRole = Role::create(['name' => 'Administrador']);
        $secretaryRole = Role::create(['name' => 'Secretaria']);
        $doctorRole = Role::create(['name' => 'Medico']);
        $patientRole = Role::create(['name' => 'Paciente']);
        $guestRole = Role::create(['name' => 'Invitado']);

        // Permisos de administrador (todos)
        $adminRole->givePermissionTo(Permission::all());

        // Permisos de la secretaria
        $secretaryRole->givePermissionTo([
            'appointments.create',
            'appointments.edit',
            'appointments.show',
            'appointments.delete',
            'patients.create',
            'patients.edit',
            'patients.delete',
            'patients.show',
            'doctors.show',
            'histories.show',
        ]);

        // Permisos del Doctor
        $doctorRole->givePermissionTo([
            'appointments.show',
            'patients.show',
            'histories.show',
            'histories.edit',
        ]);

        // Permisos del paciente
        $patientRole->givePermissionTo([
            'appointments.show', //Para que pueda ver sus propias citas
        ]);

        // Permisos del invitado (ninguno, solo puede registrarse)
        $guestRole->givePermissionTo([
            
        ]);
    }
}

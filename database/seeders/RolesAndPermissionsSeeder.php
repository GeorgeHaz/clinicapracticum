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

        // Crear permisos
        Permission::create(['name' => 'create appointments']);
        Permission::create(['name' => 'edit appointments']);
        Permission::create(['name' => 'delete appointments']);
        Permission::create(['name' => 'view appointments']);

        Permission::create(['name' => 'create patients']);
        Permission::create(['name' => 'edit patients']);
        Permission::create(['name' => 'delete patients']);
        Permission::create(['name' => 'view patients']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);

        Permission::create(['name' => 'create specialties']);
        Permission::create(['name' => 'edit specialties']);
        Permission::create(['name' => 'delete specialties']);
        Permission::create(['name' => 'view specialties']);

        Permission::create(['name' => 'create doctors']);
        Permission::create(['name' => 'edit doctors']);
        Permission::create(['name' => 'delete doctors']);
        Permission::create(['name' => 'view doctors']);

        Permission::create(['name' => 'create secretaries']);
        Permission::create(['name' => 'edit secretaries']);
        Permission::create(['name' => 'delete secretaries']);
        Permission::create(['name' => 'view secretaries']);

        Permission::create(['name' => 'view history']);
        Permission::create(['name' => 'edit history']);
        Permission::create(['name' => 'create history']);
        Permission::create(['name' => 'delete history']);

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
            'create appointments',
            'edit appointments',
            'delete appointments',
            'view appointments',
            'create patients',
            'edit patients',
            'delete patients',
            'view patients',
            'view doctors',
            'create history',
        ]);

        // Permisos del Doctor
        $doctorRole->givePermissionTo([
            'view appointments',
            'view patients',
            'view history',
            'edit history',
        ]);

        // Permisos del paciente
        $patientRole->givePermissionTo([
            'view appointments', //Para que pueda ver sus propias citas
        ]);

        // Permisos del invitado (ninguno, solo puede registrarse)
        $guestRole->givePermissionTo([
            'create appointments',
        ]);
    }
}

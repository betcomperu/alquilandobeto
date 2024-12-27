<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        Permission::firstOrCreate(['name' => 'view User']);
        Permission::firstOrCreate(['name' => 'create User']);
        Permission::firstOrCreate(['name' => 'update User']);
        Permission::firstOrCreate(['name' => 'delete User']);

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $inquilinoRole = Role::firstOrCreate(['name' => 'Inquilino']);

        // Asignar permisos al rol Administrador
        $adminRole->givePermissionTo(Permission::all());

        // Asignar permisos específicos al rol Inquilino
        $inquilinoRole->givePermissionTo(['view User']);
    }
}

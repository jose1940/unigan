<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ── PERMISOS ──────────────────────────────────────────────
        $permisos = [
            // Animales
            'ver animales', 'crear animales', 'editar animales', 'eliminar animales',
            // Inventario
            'ver inventario', 'gestionar inventario',
            // Registros médicos
            'ver registros medicos', 'crear registros medicos', 'editar registros medicos', 'eliminar registros medicos',
            // Usuarios
            'ver usuarios', 'gestionar usuarios',
            // Reportes
            'ver reportes', 'exportar reportes',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // ── ROLES ─────────────────────────────────────────────────

    
     $superAdmin = Role::firstOrCreate(['name' => 'super admin']);
     $superAdmin->givePermissionTo(Permission::all());
       
        $admin = Role::firstOrCreate(['name' => 'administrador']);
        $admin->syncPermissions([
            'ver animales', 'crear animales', 'editar animales', 'eliminar animales',
            'ver inventario', 'gestionar inventario',
            'ver registros medicos',
            'ver reportes', 'exportar reportes',
        ]);

        $veterinario = Role::firstOrCreate(['name' => 'veterinario']);
        $veterinario->syncPermissions([
              'ver animales',
    'ver registros medicos', 'crear registros medicos', 'editar registros medicos', 'eliminar registros medicos',
]);
        

        $trabajador = Role::firstOrCreate(['name' => 'trabajador']);
        $trabajador->syncPermissions([
            'ver animales',
            'ver inventario',
            'ver registros medicos',
            'ver reportes',
        ]);

    
        
    }
}
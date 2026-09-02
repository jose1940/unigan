<?php
// database/seeders/RolesAndPermissionsSeeder.php

namespace Database\Seeders; 

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ── PERMISOS ──────────────────────────────────────────────
        $permisos = [
            // Animales
            'ver animales', 'crear animales', 'editar animales', 'eliminar animales',

            // Inventario
            'ver inventario', 'gestionar inventario',

            // Salud / Veterinaria
            'ver registros medicos', 'crear registros medicos', 'editar registros medicos',

            // Usuarios
            'ver usuarios', 'gestionar usuarios',

            // Reportes
            'ver reportes', 'exportar reportes',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // ── ROLES ─────────────────────────────────────────────────

        // 👑 Propietario: acceso total
        $propietario = Role::firstOrCreate(['name' => 'propietario']);
        $propietario->givePermissionTo(Permission::all());

        // 🛠️ Administrador: todo excepto gestionar usuarios
        $admin = Role::firstOrCreate(['name' => 'administrador']);
        $admin->givePermissionTo([
            'ver animales', 'crear animales', 'editar animales', 'eliminar animales',
            'ver inventario', 'gestionar inventario',
            'ver registros medicos', 'crear registros medicos', 'editar registros medicos',
            'ver reportes', 'exportar reportes',
        ]);

        // 👨‍⚕️ Veterinario: enfocado en salud animal
        $veterinario = Role::firstOrCreate(['name' => 'veterinario']);
        $veterinario->givePermissionTo([
            'ver animales', 'editar animales',
            'ver registros medicos', 'crear registros medicos', 'editar registros medicos',
            'ver inventario',
        ]);

        // 👷 Trabajador: operaciones básicas
        $trabajador = Role::firstOrCreate(['name' => 'trabajador']);
        $trabajador->givePermissionTo([
            'ver animales', 'crear animales', 'editar animales',
            'ver inventario',
        ]);

        // 👁️ Invitado: solo lectura
        $invitado = Role::firstOrCreate(['name' => 'invitado']);
        $invitado->givePermissionTo([
            'ver animales', 'ver inventario', 'ver registros medicos',
        ]);
    }
}
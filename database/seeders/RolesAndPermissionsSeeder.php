<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ===== PERMISOS =====
        $permissions = [
            // Dashboard
            'view dashboard',
            
            // Usuarios
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Vehículos
            'view vehicles',
            'create vehicles',
            'edit vehicles',
            'delete vehicles',
            
            // Lavados
            'view washes',
            'create washes',
            'edit washes',
            'delete washes',
            'manage washes', // Para empleados
            
            // Reportes
            'view reports',
            'export reports',
            
            // Configuración
            'manage settings',
            'manage empresa',
            
            // Perfil
            'edit profile',
            'change password',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // ===== ROLES =====
        // Admin - Todos los permisos
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        // Usuario (Empleado) - Permisos limitados
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);
        $userPermissions = [
            'view dashboard',
            'view washes',
            'manage washes',
            'edit profile',
            'change password',
        ];
        $userRole->givePermissionTo($userPermissions);

        // Cliente - Permisos básicos
        $clientRole = Role::create(['name' => 'client', 'guard_name' => 'web']);
        $clientPermissions = [
            'view dashboard',
            'view vehicles',
            'create vehicles',
            'edit vehicles',
            'view washes',
            'create washes',
            'edit profile',
            'change password',
        ];
        $clientRole->givePermissionTo($clientPermissions);

        // ===== CREAR USUARIO ADMIN =====
        $admin = User::create([
            'name' => 'Admin',
            'apellido' => 'Endara',
            'email' => 'admin@endara.com',
            'telefono' => '123456789',
            'password' => bcrypt('Admin123'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // ===== CREAR USUARIO EMPLEADO =====
        $empleado = User::create([
            'name' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'empleado@endara.com',
            'telefono' => '987654321',
            'password' => bcrypt('Empleado123'),
            'email_verified_at' => now(),
        ]);
        $empleado->assignRole('user');

        // ===== CREAR USUARIO CLIENTE =====
        $cliente = User::create([
            'name' => 'María',
            'apellido' => 'García',
            'email' => 'cliente@endara.com',
            'telefono' => '555555555',
            'password' => bcrypt('Cliente123'),
            'email_verified_at' => now(),
        ]);
        $cliente->assignRole('client');

        $this->command->info('Roles y permisos creados exitosamente.');
        $this->command->info('Usuarios de prueba:');
        $this->command->info('- Admin: admin@endara.com / Admin123');
        $this->command->info('- Empleado: empleado@endara.com / Empleado123');
        $this->command->info('- Cliente: cliente@endara.com / Cliente123');
    }
}
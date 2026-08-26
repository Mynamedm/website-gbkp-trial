<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $guard = 'web';

        $permissions = [
            'manage users',
            'manage events',
            'manage schedules',
            'manage announcements',
            'manage reflections',
            'manage organizations',
            'manage categories',
            'view events',
            'view schedules',
            'view announcements',
        ];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm, 'guard_name' => $guard]);
        }

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Super Admin - bisa semua
        $superAdmin = Role::create(['name' => 'super_admin', 'guard_name' => $guard]);
        $superAdmin->syncPermissions($permissions);

        // Admin - selain CRUD user
        $admin = Role::create(['name' => 'admin', 'guard_name' => $guard]);
        $admin->syncPermissions([
            'manage events',
            'manage schedules',
            'manage announcements',
            'manage reflections',
            'manage organizations',
            'manage categories',
            'view events',
            'view schedules',
            'view announcements',
        ]);

        // User - hanya milik sendiri
        $user = Role::create(['name' => 'user', 'guard_name' => $guard]);
        $user->syncPermissions([
            'view events',
            'view schedules',
            'view announcements',
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}

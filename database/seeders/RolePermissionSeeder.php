<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define permission groups
        $permissionGroups = [
            'Dashboard & Profile' => [
                'dashboard',
                'user.profile',
                'user.update_profile',
            ],
            'General Settings' => [
                'general.setting',
                'setting.qr_code',
                'mail.setup',
                'mail.test',
            ],
            'User Management' => [
                'user.list',
                'user.create',
                'user.edit',
                'user.delete',
                'role.list',
                'role.create',
                'role.edit',
                'role.delete',
                'role.permission',
                'role.assign.permission'
            ],
        ];

        // Create permissions with group
        $allPermissions = [];
        foreach ($permissionGroups as $group => $permissions) {
            foreach ($permissions as $permission) {
                $perm = Permission::firstOrCreate(
                    ['name' => $permission],
                    ['group_name' => $group],
                    ['guard_name' => 'web']
                );
                $allPermissions[] = $perm->name;
            }
        }

        // Create roles
        $admin     = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $developer = Role::firstOrCreate(['name' => 'developer', 'guard_name' => 'web']);
        $staff = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);

        // Assign permissions to roles
        $admin->givePermissionTo($allPermissions);
        $developer->givePermissionTo($allPermissions);
        $staff->givePermissionTo([
            'dashboard',
            'user.profile',
            'user.update_profile',
        ]);

        // Assign roles to users
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        $developerUser = User::find(2);
        if ($developerUser) {
            $developerUser->assignRole('developer');
        }

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}

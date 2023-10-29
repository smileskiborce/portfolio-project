<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // FOR USERS
        collect([
            \App\Enums\Permission::CREATE_USER,
            \App\Enums\Permission::EDIT_USER,
            \App\Enums\Permission::DELETE_USER,
            \App\Enums\Permission::VIEW_USER,
        ])->each(function ($permission) {
            Permission::query()->firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        });

        Role::query()->firstOrCreate([
            'name' => \App\Enums\Role::SUPER_ADMIN,
            'guard_name' => 'web',
        ]);
        Role::query()->firstOrCreate([
            'name' => 'Test Role',
            'guard_name' => 'web',
        ]);
    }
}

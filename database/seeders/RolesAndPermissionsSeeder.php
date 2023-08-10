<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        Permission::create(['name' => 'add-user']);
        Permission::create(['name' => 'list-users']);
        Permission::create(['name' => 'show-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);

        Permission::create(['name' => 'add-role']);
        Permission::create(['name' => 'list-roles']);
        Permission::create(['name' => 'show-role']);
        Permission::create(['name' => 'edit-role']);
        Permission::create(['name' => 'delete-role']);

        Permission::create(['name' => 'add-permission']);
        Permission::create(['name' => 'list-permissions']);
        Permission::create(['name' => 'show-permission']);
        Permission::create(['name' => 'edit-permission']);
        Permission::create(['name' => 'delete-permission']);

        // create roles and assign created permissions
        
        $role = Role::create(['name' => 'Super admin']);
        $role->givePermissionTo(Permission::all());
    }
}

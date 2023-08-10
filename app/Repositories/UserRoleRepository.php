<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleRepository
{
    public function getRoles($request)
    {
        $hasFilters = false;
        $items = Role::orderBy('name', 'ASC');

        if ($request->has('id') && $request->id != '') {
            $items->where('id', '=', $request->id);
            $hasFilters = true;
        }
        if ($request->has('name') && $request->name != '') {
            $items->where('name', 'LIKE', '%' . $request->name . '%');
            $hasFilters = true;
        }
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
            $hasFilters = true;
        } else {
            $perPage = $request->perPage;
        }

        $items = $items->paginate($perPage)->withQueryString();
        return [
            'items' => $items,
            'hasFilters' => $hasFilters,
            'perPage' => $perPage,
        ];
    }

    public function getPermissions()
    {
        return Permission::all();
    }

    public function getRole($id)
    {
        return Role::with('permissions')->where('id', $id)->first();
    }

    // save a new user role
    public function storeUserRole($request): bool
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->guard_name = 'web';
        $role->save();

        $permissions = $request->has('permissions') ? $request->input('permissions') : [];
        $role->syncPermissions(Permission::whereIn('id', $permissions)->get());

        return true;
    }

    // update a new user role
    public function updateUserRole($request, $id): bool
    {
        $role = Role::where('id', $id)->first();
        if ($role === null) {
            return false;
        }

        $role->name = $request->input('name');
        $role->save();

        $permissions = $request->has('permissions') ? $request->input('permissions') : [];
        $role->syncPermissions(Permission::whereIn('id', $permissions)->get());

        return true;
    }

    // delete a user role
    public function deleteUserRole($id): ?bool
    {
        $role =  Role::where('id', $id)->first();

        // not found
        if (is_null($role)) {
            return false;
        }

        // do not delete if user role is assign
        if ($role->users->count()) {
            return false;
        }

        // Auto removes associated permissions
        //$role->revokePermissionTo(Permission::all());
        return $role->delete();
    }
}

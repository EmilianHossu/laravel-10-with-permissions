<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{

    public function getPermissions($request)
    {
        $hasFilters = false;
        $items = Permission::orderBy('name', 'ASC');

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

    public function getPermission($id)
    {
        return Permission::with('roles')->where('id', '=', $id)->first();
    }


    /**
     * @param $request
     * @return bool
     */
    public function storePermission($request): bool
    {
        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->guard_name = 'web';
        return $permission->save();
    }

    /**
     * @param $request
     * @param int $id
     * @return bool
     */
    public function updatePermission($request, int $id): bool
    {
        $permission = Permission::where('id', '=', $id)->first();

        if ($permission === null) {
            return false;
        }

        $permission->name = $request->input('name');
        return $permission->save();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePermission($id): bool
    {
        $permission = Permission::where('id', $id)->first();

        // not found
        if (is_null($permission)) {
            return false;
        }

        // do not delete if permission is assign
        if ($permission->roles->count()) {
            return false;
        }

        return $permission->delete();
    }
}

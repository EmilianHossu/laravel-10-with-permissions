<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository
{
    public function getUsers($request)
    {
        $hasFilters = false;
        $items = User::with('Roles')->orderBy('name');

        if ($request->has('email')) {
            $items->where('email', 'LIKE', '%' . $request->email . '%');
            $hasFilters = true;
        }
        if ($request->has('id') && $request->id != '') {
            $items->where('id', '=', $request->id);
            $hasFilters = true;
        }
        if ($request->has('active') && $request->active != '') {
            $items->where('active', '=', (int)$request->active);
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

    public function getRoles()
    {
        return Role::all()->pluck('name', 'id');
    }

    public function saveUser($request)
    {

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->active = $request->active ?? 0;
        // change this for the default password --
        $user->password = Hash::make('default1234password');

        if ($user->save()) {
            $user->assignRole(Role::where('id', $request->input('role_id'))->get());
            return true;
        }
        return false;
    }

    public function getUser($id)
    {
        return User::where('id', '=', $id)->first();
    }

    public function updateUser($request, $isAdmin)
    {
        $user = User::where('id', '=', $request->id)->first();

        if ($user) {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->active = (int)$request->active;

            if ($request->has('password') && !empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            if ($isAdmin) {
                $currentRoles = $user->getRoleNames();
                if (!$currentRoles->contains($request->role_id)) {
                    $user->syncRoles(Role::where('id', $request->input('role_id'))->get());
                }
            }
            if ($user->save()) {
                return true;
            }
        }
        return false;
    }

    public function deleteUser($id)
    {
        $item = User::where('id', '=', $id)->first();
        if (!$item->is_admin || !$item->active) {
            return $item->delete();
        }
        return false;
    }
}

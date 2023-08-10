<?php

namespace App\Http\Controllers;

use App\Repositories\UserRoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRoleRequest;
use Illuminate\View\View;

class UserRoleController extends Controller
{
    /**
     * @var UserRoleRepository
     */
    protected $repository;

    /**
     * ArticleController constructor.
     * @param UserRoleRepository $userRoleRepository
     */
    public function __construct(UserRoleRepository  $userRoleRepository)
    {
        $this->repository = $userRoleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        // Check for authorization
        $this->authorize("list-roles");

        $data = $this->repository->getRoles($request);

        return view('settings.roles.index')
            ->with('items', $data['items'])
            ->with('hasFilters', $data['hasFilters'])
            ->with('perPage', $data['perPage'])
            ->with('params', $request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): View
    {
        // Check for authorization
        $this->authorize("add-role");

        return view('settings.roles.add')
            ->with('permissions', $this->repository->getPermissions());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRoleRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRoleRequest $userRoleRequest)
    {
        // Check for authorization
        $this->authorize("add-role");

        $save = $this->repository->storeUserRole($userRoleRequest);
        if ($save) {
            return redirect()->route('user-roles')->with(['success' => __('Success.')]);
        }

        return redirect()->route('user-roles')->with(['error' => __('Error.')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        // Check for authorization
        $this->authorize("edit-role");

        $role = $this->repository->getRole($id);
        if ($role !== null) {
            return response(
                view('settings.roles.edit')
                    ->with('role', $role)
                    ->with('permissions', $this->repository->getPermissions())
            );
        }
        return redirect()->route('user-roles')->with(['error' => __('Error.')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRoleRequest $userRoleRequest, $id)
    {
        // Check for authorization
        $this->authorize("edit-role");

        $update = $this->repository->updateUserRole($userRoleRequest, $id);
        if ($update) {
            return redirect()->route('user-roles')->with(['success' => __('Success.')]);
        }
        return redirect()->route('user-roles')->with(['error' => __('Error.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Check for authorization
        $this->authorize("delete-role");

        $delete = $this->repository->deleteUserRole($id);
        if ($delete) {
            return redirect()->route('user-roles')->with(['success' => __('Success.')]);
        }
        return redirect()->route('user-roles')->with(['error' => __('Error.')]);
    }
}

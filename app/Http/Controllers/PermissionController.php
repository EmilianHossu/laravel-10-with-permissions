<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PermissionController extends Controller
{

    /**
     * @var PermissionRepository
     */
    protected $repository;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository  $permissionRepository)
    {
        $this->repository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request): View
    {
        // Check for authorization
        $this->authorize("list-permissions");

        $data = $this->repository->getPermissions($request);

        return view('settings.permissions.index')
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
        $this->authorize("add-permission");

        return view('settings.permissions.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
        // Check for authorization
        $this->authorize("add-permission");

        $save = $this->repository->storePermission($request);
        if ($save) {
            return redirect()->route('permissions')->with(['success' => __('Success.')]);
        }
        return redirect()->route('permissions')->with(['error' => __('Error.')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return (\Illuminate\View\View | \Illuminate\Http\RedirectResponse)
     */
    public function edit(int $id): View | RedirectResponse
    {
        // Check for authorization
        $this->authorize("edit-permission");

        $item = $this->repository->getPermission($id);
        if ($item !== null) {
            return
                view('settings.permissions.edit')
                    ->with('permission', $item);
        }
        return redirect()->route('permissions')->with(['error' => __('Error getting permission.')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionRequest $request, int $id)
    {
        // Check for authorization
        $this->authorize("edit-permission");

        $update = $this->repository->updatePermission($request, $id);
        if ($update) {
            return redirect()->route('permissions')->with(['success' => __('Success.')]);
        }
        return redirect()->route('permissions')->with(['error' => __('Error.')]);
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
        $this->authorize("delete-permission");

        $delete = $this->repository->deletePermission($id);
        if ($delete) {
            return redirect()->route('permissions')->with(['success' => __('Success.')]);
        }
        return redirect()->route('permissions')->with(['error' => __('Error.')]);
    }
}

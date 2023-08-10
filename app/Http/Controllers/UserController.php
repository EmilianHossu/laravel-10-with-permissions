<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * PermissionController constructor.
     * @param UserRepository $UserRepository
     */
    public function __construct(UserRepository  $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function index(Request $request)
    {
        // Check for authorization
        $this->authorize("list-users");

        $data = $this->repository->getUsers($request);

        return view('settings.users.index')
            ->with('items', $data['items'])
            ->with('hasFilters', $data['hasFilters'])
            ->with('perPage', $data['perPage'])
            ->with('params', $request->all());
    }

    public function create()
    {
        // Check for authorization
        $this->authorize("add-user");

        return view('settings.users.add')
            ->with('roles', $this->repository->getRoles());
    }

    public function store(UserRequest $request)
    {
        $this->authorize("add-user");

        $item = $this->repository->saveUser($request);
        if ($item) {
            return redirect()->route('users')->with('success', __('User added.'));
        } else {
            return redirect()->back()->withInput()->with('error', __('Could not save user.'));
        }
    }

    public function edit($id)
    {
        $this->authorize("edit-user");

        if (Auth::user()->is_admin || Auth::user()->id == $id) {
            $item = $this->repository->getUser($id);
            if ($item) {
                return view('settings.users.edit')
                    ->with('roles', $this->repository->getRoles())
                    ->with('item', $item);
            }
        } else {
            abort(403);
        }
    }

    public function update(UserRequest $request, $id)
    {
        $this->authorize("edit-user");

        if (Auth::user()->is_admin || Auth::user()->id == $id) {
            $item = $this->repository->updateUser($request, Auth::user()->is_admin);
            if ($item) {
                return redirect()->route('users')->with('success', __('Updated.'));
            }
            return redirect()->back()->withInput()->with('error', __('Error.'));
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        $this->authorize("delete-user");

        $item = $this->repository->deleteUser($id);

        if ($item) {
            return redirect()->back()->with('success', __('User deleted.'));
        }
        return redirect()->back()->with('error', __('Could not delete the user.'));
    }
}

<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private function getSectionNames(): Collection
    {
        return DB::table('permissions')
            ->select('name')
            ->groupBy('name')
            ->get();
    }

    public function index()
    {
        $users = User::query()->where('role_id', '>', 1)->get();

        return view('admin.pages.users.index', [
            'users'    => $users,
            'sections' => $this->getSectionNames()
        ]);
    }

    public function create()
    {
        $roles = Role::query()->where('is_hidden', false)->get();
        $permissions = Permission::all();

        return view('admin.pages.users.form', [
            'roles' => $roles,
            'permissions' => $permissions,
            'sections' => $this->getSectionNames(),
        ]);
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $user = User::query()->create($request->validated());

        if ($request->input('permissions')) {
            $user->permissions()->attach($request->input('permissions'));
        }

        if (auth()->user()->isAdmin()) {
            return redirect()->route('clients.index');
        }

        return redirect()
            ->route('users.index')
            ->with('success', __('_record.added'));
    }

    public function edit(User $user)
    {
        $roles = Role::query()->where('is_hidden', false)->get();
        $permissions = Permission::all();

        return view('admin.pages.users.form', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'sections' => $this->getSectionNames(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        $user->permissions()->detach();

        if ($request->input('permissions')) {
            $user->permissions()->attach($request->input('permissions'));
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', __('_record.deleted'));
    }
}

<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->where('is_hidden', false)->get();

        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.pages.users.form', [
            'roles' => $roles
        ]);
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        User::query()->create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', __('_record.added'));
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.pages.users.form', [
            'user'  => $user,
            'roles' => $roles
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

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

<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin.pages.profile.form', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        return $request->all();
    }
}

<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = User::query()
            ->where('role_id', Role::INSTRUCTOR)
            ->get();

        return view('admin.pages.trainers.index', compact('trainers'));
    }

    public function show(User $trainer)
    {
        return view('admin.pages.trainers.show', compact('trainer'));
    }
}

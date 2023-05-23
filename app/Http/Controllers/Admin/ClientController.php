<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::query()
            ->where('role_id', Role::CLIENT)
            ->get();

        return view('admin.pages.clients.index', compact('clients'));
    }

    public function show(User $client)
    {
        return view('admin.pages.clients.show', compact('client'));
    }
}

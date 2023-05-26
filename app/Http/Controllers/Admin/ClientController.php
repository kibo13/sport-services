<?php

namespace App\Http\Controllers\Admin;


use App\Exports\ClientExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Client\ClientRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ClientController extends Controller
{
    public function index(ClientRepositoryInterface $clientRepository)
    {
        $clients = $clientRepository->getAll();

        return view('admin.pages.clients.index', compact('clients'));
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new ClientExport(), 'clients.xlsx');
    }

    public function show(User $client)
    {
        return view('admin.pages.clients.show', compact('client'));
    }
}

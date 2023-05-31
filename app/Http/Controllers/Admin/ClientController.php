<?php

namespace App\Http\Controllers\Admin;


use App\Exports\ClientExport;
use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\User;
use App\Repositories\Client\ClientRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function edit(User $client)
    {
        $benefits = Benefit::all();

        return view('admin.pages.clients.form', [
            'client' => $client,
            'benefits' => $benefits
        ]);
    }

    public function update(Request $request, User $client): RedirectResponse
    {
        $certificate = $client->getOriginal('certificate');

        if ($request->has('certificate')) {
            Storage::disk('public')->delete($certificate);
            $certificate = $request->file('certificate')->store('certificates', 'public');
        }

        $client->update([
            'benefit_id'  => $request['benefit_id'],
            'certificate' => $certificate,
        ]);

        return redirect()
            ->route('clients.index')
            ->with('success', __('_record.updated'));
    }
}

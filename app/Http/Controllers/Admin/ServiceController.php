<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('admin.pages.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.pages.services.form');
    }

    public function store(Request $request): RedirectResponse
    {
        Service::query()->create($request->all());

        return redirect()
            ->route('services.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Service $service)
    {
        return view('admin.pages.services.form', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $service->update($request->all());

        return redirect()
            ->route('services.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', __('_record.deleted'));
    }
}

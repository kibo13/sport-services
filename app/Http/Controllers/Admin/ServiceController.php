<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Service\ServiceActivity;
use App\Enums\Service\ServiceCategory;
use App\Enums\Service\ServiceType;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $activities = ServiceActivity::NAMES;
        $types      = ServiceType::NAMES;
        $categories = ServiceCategory::NAMES;
        $services   = Service::all();

        return view('admin.pages.services.index', [
            'activities' => $activities,
            'types'      => $types,
            'categories' => $categories,
            'services'   => $services,
        ]);
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
}

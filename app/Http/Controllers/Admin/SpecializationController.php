<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::all();

        return view('admin.pages.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('admin.pages.specializations.form');
    }

    public function store(Request $request): RedirectResponse
    {
        Specialization::query()->create($request->all());

        return redirect()
            ->route('specializations.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Specialization $specialization)
    {
        return view('admin.pages.specializations.form', compact('specialization'));
    }

    public function update(Request $request, Specialization $specialization)
    {
        $specialization->update($request->all());

        return redirect()
            ->route('specializations.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Specialization $specialization): RedirectResponse
    {
        $specialization->delete();

        return redirect()
            ->route('specializations.index')
            ->with('success', __('_record.deleted'));
    }
}

<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        $benefits = Benefit::all();

        return view('admin.pages.benefits.index', compact('benefits'));
    }

    public function create()
    {
        return view('admin.pages.benefits.form');
    }

    public function store(Request $request): RedirectResponse
    {
        Benefit::query()->create($request->all());

        return redirect()
            ->route('benefits.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Benefit $benefit)
    {
        return view('admin.pages.benefits.form', compact('benefit'));
    }

    public function update(Request $request, Benefit $benefit): RedirectResponse
    {
        $benefit->update($request->all());

        return redirect()
            ->route('benefits.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Benefit $benefit): RedirectResponse
    {
        $benefit->delete();

        return redirect()
            ->route('benefits.index')
            ->with('success', __('_record.deleted'));
    }
}

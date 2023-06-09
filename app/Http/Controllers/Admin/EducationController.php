<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::all();

        return view('admin.pages.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.pages.educations.form');
    }

    public function store(Request $request): RedirectResponse
    {
        Education::query()->create($request->all());

        return redirect()
            ->route('educations.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Education $education)
    {
        return view('admin.pages.educations.form', compact('education'));
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $education->update($request->all());

        return redirect()
            ->route('educations.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();

        return redirect()
            ->route('educations.index')
            ->with('success', __('_record.deleted'));
    }
}

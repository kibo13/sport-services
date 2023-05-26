<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Pass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PassController extends Controller
{
    public function index()
    {
        $passes = Pass::all();

        return view('admin.pages.passes.index', compact('passes'));
    }

    public function create()
    {
        return view('admin.pages.passes.form');
    }

    public function store(Request $request): RedirectResponse
    {
        Pass::query()->create($request->all());

        return redirect()
            ->route('passes.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Pass $pass)
    {
        return view('admin.pages.passes.form', compact('pass'));
    }

    public function update(Request $request, Pass $pass): RedirectResponse
    {
        $pass->update($request->all());

        return redirect()
            ->route('passes.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Pass $pass): RedirectResponse
    {
        $pass->delete();

        return redirect()
            ->route('passes.index')
            ->with('success', __('_record.deleted'));
    }
}

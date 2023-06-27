<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Method\CreateMethodRequest;
use App\Http\Requests\Method\UpdateMethodRequest;
use App\Models\Activity;
use App\Models\Method;
use Illuminate\Http\RedirectResponse;

class MethodController extends Controller
{
    public function index()
    {
        $methods = Method::query()->orderBy('activity_id')->get();

        return view('admin.pages.methods.index', compact('methods'));
    }

    public function create()
    {
        $activities = Activity::all();

        return view('admin.pages.methods.form', compact('activities'));
    }

    public function store(CreateMethodRequest $request): RedirectResponse
    {
        Method::query()->create($request->validated());

        return redirect()
            ->route('methods.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Method $method)
    {
        $activities = Activity::all();

        return view('admin.pages.methods.form', [
            'method' => $method,
            'activities' => $activities,
        ]);
    }

    public function update(UpdateMethodRequest $request, Method $method): RedirectResponse
    {
        $method->update($request->validated());

        return redirect()
            ->route('methods.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Method $method): RedirectResponse
    {
        $method->delete();

        return redirect()
            ->route('methods.index')
            ->with('success', __('_record.deleted'));
    }
}

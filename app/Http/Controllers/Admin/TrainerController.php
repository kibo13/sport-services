<?php

namespace App\Http\Controllers\Admin;


use App\Exports\TrainerExport;
use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Specialization;
use App\Models\User;
use App\Repositories\Trainer\TrainerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TrainerController extends Controller
{
    public function index(TrainerRepositoryInterface $trainerRepository)
    {
        $trainers = $trainerRepository->getAll();

        return view('admin.pages.trainers.index', compact('trainers'));
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new TrainerExport(), 'trainers.xlsx');
    }

    public function edit(User $trainer)
    {
        $educations = Education::all();
        $specializations = Specialization::all();

        return view('admin.pages.trainers.form', [
            'trainer' => $trainer,
            'educations' => $educations,
            'specializations' => $specializations
        ]);
    }

    public function update(Request $request, User $trainer): RedirectResponse
    {
        $trainer->update($request->all());
        $specializations = $request->input('specializations', []);
        $trainer->specializations()->sync($specializations);
        $trainer->save();

        return redirect()
            ->route('trainers.index')
            ->with('success', __('_record.updated'));
    }
}

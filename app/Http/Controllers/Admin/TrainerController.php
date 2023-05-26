<?php

namespace App\Http\Controllers\Admin;


use App\Exports\TrainerExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Trainer\TrainerRepositoryInterface;
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

    public function show(User $trainer)
    {
        return view('admin.pages.trainers.show', compact('trainer'));
    }
}

<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\Timetable\TimetableRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller
{
    public function index(TimetableRepositoryInterface $timetableRepository): JsonResponse
    {
        $authorizedUser = Auth::user();
        $lessons = $timetableRepository->getAllLessons($authorizedUser);

        return response()->json($lessons);
    }
}

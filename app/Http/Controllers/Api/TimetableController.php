<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\Timetable\TimetableRepositoryInterface;
use Illuminate\Http\JsonResponse;

class TimetableController extends Controller
{
    public function index(TimetableRepositoryInterface $timetableRepository): JsonResponse
    {
        $events = $timetableRepository->getAllLessons();

        return response()->json($events);
    }
}

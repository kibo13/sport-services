<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Repositories\Card\CardRepositoryInterface;
use Illuminate\Http\Request;

class CardLessonController extends Controller
{
    public function index(CardRepositoryInterface $cardRepository)
    {
        $user = auth()->user();
        $activities = Activity::all();
        $activityIds = $activities->pluck('id')->toArray();
        $cards = $cardRepository->getActiveLessonsByActivitiesAndClient($activityIds, $user->id);

        return view('admin.pages.lessons.index', [
            'activities' => $activities,
            'cards' => $cards
        ]);
    }
}

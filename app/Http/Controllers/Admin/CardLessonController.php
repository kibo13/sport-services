<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Card;
use App\Models\CardLesson;
use App\Repositories\Card\CardRepositoryInterface;
use Illuminate\Http\RedirectResponse;
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

    public function management(Request $request)
    {
        $searchQuery = $request->input('search');

        $request->session()->put('search', $searchQuery);

        $card = $searchQuery ? Card::query()->find($searchQuery) : null;

        return view('admin.pages.lessons.management', [
            'searchQuery' => $searchQuery,
            'card' => $card,
        ]);
    }

    public function update(Request $request, CardLesson $lesson): RedirectResponse
    {
        $lesson->update($request->all());

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Activity as ActivityEnum;
use App\Enums\Lesson\LessonCount;
use App\Http\Controllers\Controller;
use App\Jobs\Client\SendMessageJob;
use App\Models\Activity;
use App\Models\Card;
use App\Models\CardLesson;
use App\Models\User;
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

        $card = $lesson->card;
        $client = $card->client;

        $this->sendLessonNotification($client, $card);

        return redirect()->back();
    }

    private function sendLessonNotification(User $client, Card $card)
    {
        if ($client->is_notify) {
            $activity = ActivityEnum::ENDINGS[$card->activity_id];
            $remainingLessonsCount = $card->getRemainingLessonsCount();
            $expirationDate = format_date_for_display($card->end);
            $phone = $client->phone;
            $company = 'ГБУ "СОК"';

            if ($remainingLessonsCount) {
                $remainingLessonsText = LessonCount::TEXTS[$remainingLessonsCount];
                $message = "Здравствуйте! Вы посетили 1 занятие по $activity. Осталось ещё $remainingLessonsText до $expirationDate г. $company";
            } else {
                $message = "Здравствуйте! Вы посетили последнее занятие по $activity. $company";
            }

            dispatch(new SendMessageJob($phone, $message));
        }
    }
}

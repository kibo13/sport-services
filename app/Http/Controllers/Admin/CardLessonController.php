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
        $ids = $activities->pluck('id')->toArray();
        $cards = $cardRepository->getActiveCards($ids, $user->id);

        return view('admin.pages.lessons.index', [
            'user' => $user,
            'activities' => $activities,
            'cards' => $cards
        ]);
    }
}

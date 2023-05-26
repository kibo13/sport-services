<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Event\EventType;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repositories\Trainer\TrainerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('admin.pages.events.index', compact('events'));
    }

    public function create(TrainerRepositoryInterface $trainerRepository)
    {
        $types = EventType::NAMES;
        $trainers = $trainerRepository->getAll();

        return view('admin.pages.events.form', [
            'types' => $types,
            'trainers' => $trainers
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Event::query()->create($request->all());

        return redirect()
            ->route('events.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Event $event, TrainerRepositoryInterface $trainerRepository)
    {
        $types = EventType::NAMES;
        $trainers = $trainerRepository->getAll();

        return view('admin.pages.events.form', [
            'event' => $event,
            'types' => $types,
            'trainers' => $trainers
        ]);
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $event->update($request->all());

        return redirect()
            ->route('events.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', __('_record.deleted'));
    }
}

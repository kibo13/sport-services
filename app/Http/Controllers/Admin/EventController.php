<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventResult;
use App\Models\Specialization;
use App\Repositories\Client\ClientRepositoryInterface;
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
        $specializations = Specialization::all();
        $trainers = $trainerRepository->getAll();

        return view('admin.pages.events.form', [
            'specializations' => $specializations,
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
        $specializations = Specialization::all();
        $trainers = $trainerRepository->getTrainersBySpecialization($event->specialization_id);

        return view('admin.pages.events.form', [
            'event' => $event,
            'specializations' => $specializations,
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

    public function getResult(EventResult $result, ClientRepositoryInterface $clientRepository)
    {
        $clients = $clientRepository->getAll();

        return view('admin.pages.events.result', [
            'result' => $result,
            'clients' => $clients,
        ]);
    }

    public function setResult(Request $request, EventResult $result): RedirectResponse
    {
        $result->update($request->all());

        return redirect()
            ->route('events.index')
            ->with('success', __('_record.updated'));
    }
}

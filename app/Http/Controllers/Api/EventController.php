<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Event\EventIndexResource;
use App\Repositories\Event\EventRepositoryInterface;

class EventController extends Controller
{
    public function index(EventRepositoryInterface $eventRepository)
    {
        $events = $eventRepository->getAll();

        return EventIndexResource::collection($events)->toArray(null);
    }
}

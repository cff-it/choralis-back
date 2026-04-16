<?php

namespace App\Http\Controllers;

use App\Actions\Event\CheckInMember;
use App\Actions\Event\CreateEvent;
use App\Actions\Event\SubscribeToEvent;
use App\Http\Requests\Event\CheckInRequest;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\SubscribeToEventRequest;
use App\Http\Resources\EventResource;
use App\Repositories\EventRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventController extends Controller
{
    public function index(EventRepository $events): AnonymousResourceCollection
    {
        return EventResource::collection($events->all());
    }

    public function show(int $event, EventRepository $events): EventResource
    {
        return EventResource::make($events->findById($event));
    }

    public function store(CreateEventRequest $request, CreateEvent $action): JsonResponse
    {
        $event = $action($request->toDTO());

        return EventResource::make($event)->response()->setStatusCode(201);
    }

    public function subscribe(SubscribeToEventRequest $request, int $event, SubscribeToEvent $action): JsonResponse
    {
        $subscription = $action($request->toDTO());

        return response()->json($subscription, 201);
    }

    public function checkIn(CheckInRequest $request, int $event, CheckInMember $action): JsonResponse
    {
        $check = $action($request->toDTO());

        return response()->json($check, 201);
    }
}

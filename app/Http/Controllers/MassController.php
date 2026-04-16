<?php

namespace App\Http\Controllers;

use App\Actions\Mass\AssignSongToMassPart;
use App\Actions\Mass\CreateMass;
use App\Actions\Mass\GeneratePptx;
use App\Http\Requests\Mass\AssignSongToMassPartRequest;
use App\Http\Requests\Mass\CreateMassRequest;
use App\Http\Resources\MassResource;
use App\Repositories\MassRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MassController extends Controller
{
    public function index(MassRepository $masses): AnonymousResourceCollection
    {
        return MassResource::collection($masses->all());
    }

    public function show(int $mass, MassRepository $masses): MassResource
    {
        return MassResource::make($masses->findById($mass));
    }

    public function store(CreateMassRequest $request, CreateMass $action): JsonResponse
    {
        $mass = $action($request->toDTO());

        return MassResource::make($mass)->response()->setStatusCode(201);
    }

    public function assignSong(AssignSongToMassPartRequest $request, int $mass, int $part, AssignSongToMassPart $action): JsonResponse
    {
        $massSong = $action($request->toDTO());

        return response()->json($massSong->load('song'), 201);
    }

    public function generatePptx(int $mass, GeneratePptx $action): BinaryFileResponse
    {
        $path = $action($mass);

        return response()->download($path);
    }
}

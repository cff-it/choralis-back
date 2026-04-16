<?php

namespace App\Http\Controllers;

use App\Actions\User\AssignRole;
use App\Actions\User\CreateUser;
use App\Http\Requests\User\AssignRoleRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(UserRepository $users): AnonymousResourceCollection
    {
        return UserResource::collection($users->all());
    }

    public function show(int $user, UserRepository $users): UserResource
    {
        return UserResource::make($users->findById($user));
    }

    public function store(CreateUserRequest $request, CreateUser $action): JsonResponse
    {
        $user = $action($request->toDTO());

        return UserResource::make($user)->response()->setStatusCode(201);
    }

    public function assignRole(AssignRoleRequest $request, int $user, AssignRole $action): UserResource
    {
        return UserResource::make($action($request->toDTO()));
    }
}

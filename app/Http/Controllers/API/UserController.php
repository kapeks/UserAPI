<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserIndexRequest;
use App\Http\Requests\Api\UserStoreRequest;
use App\Http\Requests\Api\UserShowRequest;
use App\Services\User\UserService;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserShowResource;
use App\Http\Resources\UserStoreResources;

class UserController extends Controller
{

    public function index(UserIndexRequest $request, UserService $service)
    {
        $data = $request->validated();

        $users = $service->getPaginatedUsers($data['count'] ?? 5, $data['page'] ?? 1);

        return new UserCollection($users);
    }

    public function store(UserStoreRequest $request, UserService $service)
    {
        $user = $service->storeUser($request->validated());

        return new UserStoreResources($user);
    }

    public function show(UserShowRequest $request, UserService $service)
    {
        $user = $service->show($request->validated());

        return new UserShowResource($user);
    }
}

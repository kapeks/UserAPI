<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\UserStoreRequest;
use App\Http\Requests\Web\UserIndexRequest;
use App\Models\Position;
use App\Services\User\UserService;
use App\Exceptions\ConflictException;
use App\Exceptions\NotFoundException;

class UserController extends Controller
{
    public function index(UserIndexRequest $request, UserService $service)
    {
        try {

            $result = $request->validated();

            $users = $service->getPaginatedUsers(6, $result['page'] ?? 1);

            return view('user.index', compact('users'));

        } catch (NotFoundException $e)
        {
            abort(404);
        }
    }

    public function create()
    {
        $positions = Position::all();

        return view('user.create', compact('positions'));
    }

    public function store(UserStoreRequest $request, UserService $service)
    {
        try {

            $service->storeUser($request->validated());
            return redirect()->route('users.index')->with('success', 'Пользователь добавлен успешно');

        } catch (ConflictException $e) {
            
            return redirect()->route('users.create')->with('error', $e->getMessage());
        }
    }
}

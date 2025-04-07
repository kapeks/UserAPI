<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Position\PositionService;
use App\Http\Resources\PositionResource;

class PositionController extends Controller
{
    public function index(PositionService $service)
    {
        $position = $service->getAll();

        return response()->json([
            'success' => true,
            'positions' => PositionResource::collection($position)
        ]);
    }
}

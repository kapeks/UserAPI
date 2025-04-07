<?php

namespace App\Services\Position;

use App\Models\Position;
use App\Exceptions\NotFoundException;

class PositionService
{
    public function getAll()
    {
        $position = Position::all();

        if(empty($position)) {
            throw new NotFoundException("Positions not found");
        }

        return $position;
    }
}
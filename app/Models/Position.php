<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public function users()
    {
        return $this->HasMany(User::class);
    }
}

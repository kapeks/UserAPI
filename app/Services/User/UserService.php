<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\Image\ImageResizerService;
use App\Services\Image\ImageOptimizerService;
use App\Exceptions\ConflictException;
use App\Exceptions\NotFoundException;
use App\Jobs\ImageOptimizerJob;


class UserService
{
    public function getPaginatedUsers($count = null, $page = null)
    {

        $user = User::paginate($count);

        if ($page > $user->lastPage()) {

            throw new NotFoundException("Page not found");
        }

        return $user;
    }

    public function storeUser(array $data): User
    {
        if (User::where('email', $data['email'])->orWhere('phone', $data['phone'])->exists()) {

            throw new ConflictException('User with this email or phone already exists.');
        }
        
        // Сохраняем оригинальное фото
        $photoPath = $data['photo']->store('fotos', 'public');

        // Изменяем размер фото
        $resizerImagePath = ImageResizerService::change('storage/' . $photoPath);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'position_id' => $data['position_id'],
            'photo' => $resizerImagePath,
        ]);

        ImageOptimizerJob::dispatch($resizerImagePath, $user->id);

        return $user;
    }

    public function show($data)
    {
        $user = User::find($data['id']);
        
        if (!$user)
        {
            throw new NotFoundException('User not found');
        }

        return $user;
    }
}

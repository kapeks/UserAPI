<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TokenService
{
    public function generate(): string
    {
        $token = Str::random(60);

        // Сохраняем токен на 40 минут
        Cache::put('user_token_' . $token, true, now()->addMinutes(40));

        return $token;
    }

    public static function validate(string $token): bool
    {
        if (Cache::has('user_token_' . $token)) {
            // Удаляем токен после использования
            Cache::forget('user_token_' . $token);
            return true;
        }

        return false;
    }
}

<?php

namespace App\Services\Image;

use Illuminate\Support\Facades\Http;

class ImageOptimizerService
{
    public static function optimizeImageWithTinyPng(string $filePath)
    {
        $absolutePath = storage_path('app/public/fotos/' . basename($filePath));

        $tinypngApiKey = getenv('API_KEY_TINIFY');

        $imageContent = file_get_contents($absolutePath);

        $response = Http::withBasicAuth('api', $tinypngApiKey)
            ->withBody($imageContent, 'image/jpeg')
            ->post('https://api.tinify.com/shrink');

        if (!$response->successful()) {
            throw new \Exception('TinyPNG optimization failed');
        }

        $optimizedUrl = $response->json()['output']['url'];

        // Скачиваем оптимизированный файл и заменяем
        $optimizedImage = Http::get($optimizedUrl)->body();

        file_put_contents($absolutePath, $optimizedImage);

        return getenv('APP_URL') . '/storage/fotos/' . $filePath;
    }
}
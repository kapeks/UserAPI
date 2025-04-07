<?php

namespace App\Services\Image;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageGeneratorService
{
    public static function generateAndSaveRandomImage()
    {

        $imageUrl = 'https://randomuser.me/api/portraits/men/' . rand(1, 99) . '.jpg';

        $imageContent = Http::get($imageUrl)->body();

        $photoPath = 'fotos/';


        if (!file_exists($photoPath)) {
            mkdir($photoPath, 0755, true);
        }

        $filename = Str::random(10) . '.jpg';

        Storage::disk('public')->put($photoPath . $filename, $imageContent);

        // Путь к файлу
        $filePath = $photoPath . $filename;

        return 'storage/' . $filePath;
    }
}

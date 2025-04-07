<?php

namespace App\Services\Image;

class ImageResizerService
{
    public static function change(string $filePath)
    {
        $oldImagePath = public_path($filePath);
    
        if (!file_exists($oldImagePath)) {
            throw new \Exception("Файл не найден: " . $oldImagePath);
        }
    
        $image = imagecreatefromjpeg($oldImagePath);
    
        // Получаем размеры оригинального изображения
        list($width, $height) = getimagesize($oldImagePath);
    
        // Создаем новое изображение 70x70
        $newImage = imagecreatetruecolor(70, 70);
    
        // Обрезаем и изменяем размер
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, 70, 70, $width, $height);
    
        imagejpeg($newImage, $oldImagePath);
    
        imagedestroy($image);
        imagedestroy($newImage);
    
        // Возвращаем путь к обработанному файлу
        return basename($oldImagePath);  
    }
}

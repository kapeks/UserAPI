<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Services\Image\ImageGeneratorService;
use App\Services\Image\ImageOptimizerService;
use App\Services\Image\ImageResizerService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $positions = [
            'Designer' => 4, 
            'Security' => 3, 
            'Content manager' => 2, 
            'Lawyer' => 1, 
        ];

        // Случайным образом выбираем одну должность
        $position_name = array_rand($positions);
        $position_id = $positions[$position_name];

        // генерируем случайное изображение
        $randomImagePath = ImageGeneratorService::generateAndSaveRandomImage();
        $resizerImagePath = ImageResizerService::change($randomImagePath);
        $optimizerImagePath = ImageOptimizerService::optimizeImageWithTinyPng($resizerImagePath);

        return [
            'name' => $this->faker->firstName . ' ' . $this->faker->lastName, 
            'email' => $this->faker->unique()->safeEmail, 
            'phone' => '+380' . $this->faker->numerify('#########'), // Номер телефона, начинающийся с +380
            'position_id' => $position_id, 
            'photo' => $optimizerImagePath, 
            'registration_timestamp' => $this->faker->unixTime, 
        ];

    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Services\Image\ImageOptimizerService;

class ImageOptimizerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $photoPath;
    protected int $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $photoPath, int $userId)
    {
        $this->photoPath = $photoPath;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $optimizedPath = ImageOptimizerService::optimizeImageWithTinyPng($this->photoPath);
        $user = User::find($this->userId);
        if ($user) {
            $user->update(['photo' => $optimizedPath]);
        }
    }
}

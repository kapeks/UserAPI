<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
{
    // Отключаем автоматическую обертку
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->position->name,
            'position_id' => $this->position_id,
            'photo' => asset($this->photo),
        ];
    }

    public function toResponse($request)
    {
        return response()->json([
            'success' => true,
            'user' => $this->toArray($request),
        ], 200);
    }
}

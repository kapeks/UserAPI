<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserStoreResources extends JsonResource
{

    // Отключаем автоматическую обертку в data
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
            'success' => true,
            'user_id' => $this->id,
            'message' => 'New user successfully registered',
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(201); 
    }
}

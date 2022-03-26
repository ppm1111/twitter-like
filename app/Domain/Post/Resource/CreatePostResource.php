<?php

namespace App\Domain\Post\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatePostResource extends JsonResource
{
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
            'userId' => $this->user_id,
            'createdAt' => formatDate($this->created_at)
        ];
    }

    public function with($request)
    {
        return [
            'code' => '00000',
            'message' => 'success',
        ];
    }
}

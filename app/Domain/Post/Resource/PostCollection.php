<?php

namespace App\Domain\Post\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'code' => '00000',
            'message' => 'success',
        ];
    }
}

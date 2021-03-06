<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Request\CreatePostRequest;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Resource\PostResource;
use App\Exceptions\ForbidenException;

class GetSinglePost extends Controller
{
    private $getPostService;

    public function __construct(GetPostService $getPostService)
    {
        $this->getPostService = $getPostService;
    }

    public function __invoke($id)
    {
        $post = $this->getPostService->getById($id);
        if (empty($post)) {
            $data = [
                'module' => 'post',
                'errorType' => 'POST_NOT_FOUND',
            ];
            throw new ForbidenException($data);
        }

        return new PostResource($post);
    }
}

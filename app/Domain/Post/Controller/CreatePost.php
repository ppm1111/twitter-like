<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Request\CreatePostRequest;
use App\Domain\Post\Service\Contract\CreatePost as CreatePostService;
use App\Domain\Post\Resource\PostResource;

class CreatePost extends Controller
{
    private $createPostService;

    public function __construct(CreatePostService $createPostService)
    {
        $this->createPostService = $createPostService;
    }

    public function __invoke(CreatePostRequest $request)
    {
        $text = request()->text;
        $post = $this->createPostService->create($text);

        return new CreatePostResource($post);
    }
}
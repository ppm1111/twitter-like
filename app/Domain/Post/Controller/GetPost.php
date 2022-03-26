<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Request\CreatePostRequest;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Resource\PostCollection;

class GetPost extends Controller
{
    private $getPostService;

    public function __construct(GetPostService $getPostService)
    {
        $this->getPostService = $getPostService;
    }

    public function __invoke()
    {
        $posts = $this->getPostService->getAll();

        return new PostCollection($posts);
    }
}

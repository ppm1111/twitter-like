<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Request\CreatePostRequest;
use App\Domain\Post\Service\Contract\CreatePost as CreatePostService;
use App\Domain\Post\Service\Contract\GetAuth;
use App\Domain\Post\Resource\SimplePostResource;

class CreatePost extends Controller
{
    private $createPostService;
    private $getAuthService;

    public function __construct(
        CreatePostService $createPostService,
        GetAuth $getAuthService
        )
    {
        $this->createPostService = $createPostService;
        $this->getAuthService = $getAuthService;
    }

    public function __invoke(CreatePostRequest $request)
    {
        $text = request()->text;
        $user = $this->getAuthService->get();
        $post = $this->createPostService->create($user->id, $text);

        return new SimplePostResource($post);
    }
}

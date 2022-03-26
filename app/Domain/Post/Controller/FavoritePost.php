<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\FavoritePost as FavoritePostService;
use App\Domain\Post\Resource\PostResource;
use App\Exceptions\ForbidenException;

class FavoritePost extends Controller
{
    private $getPostService;
    private $favoritePostService;

    public function __construct(
        GetPostService $getPostService,
        FavoritePostService $favoritePostService
        )
    {
        $this->getPostService = $getPostService;
        $this->favoritePostService = $favoritePostService;
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

        $this->favoritePostService->favorite($id);

        return new PostResource($post);
    }
}

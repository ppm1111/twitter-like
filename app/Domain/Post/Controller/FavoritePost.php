<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\FavoritePost as FavoritePostService;
use App\Domain\Post\Resource\SimplePostResource;
use App\Exceptions\ForbidenException;
use App\Domain\Post\Service\Contract\GetAuth;

class FavoritePost extends Controller
{
    private $getPostService;
    private $favoritePostService;
    private $getAuthService;

    public function __construct(
        GetPostService $getPostService,
        FavoritePostService $favoritePostService,
        GetAuth $getAuthService
        )
    {
        $this->getPostService = $getPostService;
        $this->favoritePostService = $favoritePostService;
        $this->getAuthService = $getAuthService;
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
        
        $user = $this->getAuthService->get();
        $this->favoritePostService->favorite($id, $user->id);

        return new SimplePostResource($post);
    }
}

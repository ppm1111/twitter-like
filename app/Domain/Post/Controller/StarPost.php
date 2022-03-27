<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\StarPost as StarPostService;
use App\Domain\Post\Resource\SimplePostResource;
use App\Exceptions\ForbidenException;
use App\Domain\Post\Service\Contract\GetAuth;

class StarPost extends Controller
{
    private $getPostService;
    private $starPostService;
    private $getAuthService;

    public function __construct(
        GetPostService $getPostService,
        StarPostService $starPostService,
        GetAuth $getAuthService
        )
    {
        $this->getPostService = $getPostService;
        $this->starPostService = $starPostService;
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
        $this->starPostService->star($id, $user->id);

        return new SimplePostResource($post);
    }
}

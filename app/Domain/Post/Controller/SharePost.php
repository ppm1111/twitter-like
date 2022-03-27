<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\SharePost as SharePostService;
use App\Domain\Post\Resource\SimplePostResource;
use App\Domain\Post\Request\SharePostRequest;
use App\Exceptions\ForbidenException;
use App\Domain\Post\Service\Contract\GetAuth;

class SharePost extends Controller
{
    private $getPostService;
    private $sharePostService;
    private $getAuthService;

    public function __construct(
        GetPostService $getPostService,
        SharePostService $sharePostService,
        GetAuth $getAuthService
        )
    {
        $this->getPostService = $getPostService;
        $this->sharePostService = $sharePostService;
        $this->getAuthService = $getAuthService;
    }

    public function __invoke(SharePostRequest $request, $id)
    {
        $userId = request()->userId;
        $post = $this->getPostService->getById($id);
        if (empty($post)) {
            $data = [
                'module' => 'post',
                'errorType' => 'POST_NOT_FOUND',
            ];
            throw new ForbidenException($data);
        }

        $user = $this->getAuthService->get();
        $this->sharePostService->share($id, $user->id, $userId);

        return new SimplePostResource($post);
    }
}

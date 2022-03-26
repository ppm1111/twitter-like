<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\SharePost as SharePostService;
use App\Domain\Post\Resource\PostResource;
use App\Domain\Post\Request\SharePostRequest;
use App\Exceptions\ForbidenException;

class SharePost extends Controller
{
    private $getPostService;
    private $sharePostService;

    public function __construct(
        GetPostService $getPostService,
        SharePostService $sharePostService
        )
    {
        $this->getPostService = $getPostService;
        $this->sharePostService = $sharePostService;
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

        $this->sharePostService->share($id, $userId);

        return new PostResource($post);
    }
}

<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Request\DeletePostRequest;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\DeletePost as DeletePostService;
use App\Domain\Post\Resource\PostResource;
use App\Exceptions\ForbidenException;

class DeletePost extends Controller
{
    private $getPostService;
    private $deletePostService;

    public function __construct(
        GetPostService $getPostService,
        DeletePostService $deletePostService
        )
    {
        $this->getPostService = $getPostService;
        $this->deletePostService = $deletePostService;
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

        $this->deletePostService->delete($id);

        return new SimplePostResource($post);
    }
}

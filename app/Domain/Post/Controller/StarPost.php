<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\StarPost as StarPostService;
use App\Domain\Post\Resource\SimplePostResource;
use App\Exceptions\ForbidenException;

class StarPost extends Controller
{
    private $getPostService;
    private $starPostService;

    public function __construct(
        GetPostService $getPostService,
        StarPostService $starPostService
        )
    {
        $this->getPostService = $getPostService;
        $this->starPostService = $starPostService;
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

        $this->starPostService->star($id);

        return new SimplePostResource($post);
    }
}

<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\ReplyPost as replyPostService;
use App\Domain\Post\Resource\SimpleReplyResource;
use App\Exceptions\ForbidenException;

class ReplyPost extends Controller
{
    private $getPostService;
    private $replyPostService;

    public function __construct(
        GetPostService $getPostService,
        ReplyPostService $replyPostService
        )
    {
        $this->getPostService = $getPostService;
        $this->replyPostService = $replyPostService;
    }

    public function __invoke($id)
    {
        $replyText = request()->text;
        $post = $this->getPostService->getById($id);
        if (empty($post)) {
            $data = [
                'module' => 'post',
                'errorType' => 'POST_NOT_FOUND',
            ];
            throw new ForbidenException($data);
        }

        $replyPost = $this->replyPostService->reply($post->id, $replyText);

        return new SimpleReplyResource($replyPost);
    }
}

<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\GetPost as GetPostService;
use App\Domain\Post\Service\Contract\ReplyPost as replyPostService;
use App\Domain\Post\Resource\SimpleReplyResource;
use App\Exceptions\ForbidenException;
use App\Domain\Post\Service\Contract\GetAuth;

class ReplyPost extends Controller
{
    private $getPostService;
    private $replyPostService;
    private $getAuthService;

    public function __construct(
        GetPostService $getPostService,
        ReplyPostService $replyPostService,
        GetAuth $getAuthService
        )
    {
        $this->getPostService = $getPostService;
        $this->replyPostService = $replyPostService;
        $this->getAuthService = $getAuthService;
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

        $user = $this->getAuthService->get();
        $replyPost = $this->replyPostService->reply($post->id, $user->id, $replyText);

        return new SimpleReplyResource($replyPost);
    }
}

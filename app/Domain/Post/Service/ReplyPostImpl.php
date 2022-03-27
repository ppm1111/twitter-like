<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\ReplyPost;
use App\Domain\Post\Repository\ReplyRepository;
use App\Exceptions\ForbidenException;

class ReplyPostImpl implements ReplyPost
{
    private $replyRepo;

    public function __construct(ReplyRepository $replyRepo)
    {
        $this->replyRepo = $replyRepo;
    }

    public function reply($postId, $userId, $replyText)
    {
        $data = [
            'text' => $replyText,
            'user_id' => $userId,
            'post_id' => $postId,
        ];

        return $this->replyRepo->create($data);
    }

}
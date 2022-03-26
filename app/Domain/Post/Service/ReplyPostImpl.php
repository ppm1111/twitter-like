<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\ReplyPost;
use App\Domain\Post\Repository\ReplyRepository;
use App\Domain\Post\Repository\AuthRepository;
use App\Exceptions\ForbidenException;

class ReplyPostImpl implements ReplyPost
{
    private $replyRepo;
    private $authRepo;

    public function __construct(
        ReplyRepository $replyRepo,
        AuthRepository $authRepo)
    {
        $this->replyRepo = $replyRepo;
        $this->authRepo = $authRepo;
    }

    public function reply($postId, $replyText)
    {
        $user = $this->authRepo->getAuth();
        $data = [
            'text' => $replyText,
            'user_id' => $user->id,
            'post_id' => $postId,
        ];

        return $this->replyRepo->create($data);
    }

}
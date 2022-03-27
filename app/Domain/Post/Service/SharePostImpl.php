<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\SharePost;
use App\Domain\Post\Repository\PostRepository;
use App\Domain\Post\Repository\SharePostRepository;
use App\Exceptions\ForbidenException;
use DB;

class SharePostImpl implements SharePost
{
    private $postRepo;
    private $sharePostRepo;

    public function __construct(
        PostRepository $postRepo,
        SharePostRepository $sharePostRepo
        )
    {
        $this->postRepo = $postRepo;
        $this->sharePostRepo = $sharePostRepo;
    }

    public function share($id, $fromUserId, $userId)
    {
        $this->checkAlreadyShare($id, $fromUserId, $userId);
        if ($fromUserId == $userId) {
            $data = [
                'module' => 'post',
                'errorType' => 'CANNOT_SHARE_MYSELF',
            ];
            throw new ForbidenException($data);
        }

        $post = $this->postRepo->getById($id);
        $data = [
            'share_user_id' => $userId,
            'from_user_id' => $fromUserId,
            'post_id' => $post->id,
        ];
        $this->sharePostRepo->create($data);
    }

    public function checkAlreadyShare($id, $fromUserId, $userId)
    {
        $record = $this->sharePostRepo->getByUserIdAndPostId($id, $fromUserId, $userId);
        if (!empty($record)) {
            $data = [
                'module' => 'post',
                'errorType' => 'POST_ALREADY_SHARE',
            ];
            throw new ForbidenException($data);
        }
    }
}
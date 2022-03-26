<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\SharePost;
use App\Domain\Post\Repository\PostRepository;
use App\Domain\Post\Repository\AuthRepository;
use App\Domain\Post\Repository\SharePostRepository;
use App\Exceptions\ForbidenException;
use DB;

class SharePostImpl implements SharePost
{
    private $postRepo;
    private $authRepo;
    private $sharePostRepo;

    public function __construct(
        PostRepository $postRepo,
        AuthRepository $authRepo,
        SharePostRepository $sharePostRepo
        )
    {
        $this->postRepo = $postRepo;
        $this->authRepo = $authRepo;
        $this->sharePostRepo = $sharePostRepo;
    }

    public function share($id, $userId)
    {
        $user = $this->authRepo->getAuth();
        $this->checkAlreadyShare($id, $user->id);
        if ($user->id == $userId) {
            $data = [
                'module' => 'post',
                'errorType' => 'CANNOT_SHARE_MYSELF',
            ];
            throw new ForbidenException($data);
        }

        $post = $this->postRepo->getById($id);
        $data = [
            'user_id' => $userId,
            'post_id' => $post->id,
        ];
        $this->sharePostRepo->create($data);
    }

    public function checkAlreadyShare($postId, $userId)
    {
        $record = $this->sharePostRepo->getByUserIdAndPostId($postId, $userId);
        \Log::info($postId);
        \Log::info($userId);
        if (!empty($record)) {
            $data = [
                'module' => 'post',
                'errorType' => 'POST_ALREADY_SHARE',
            ];
            throw new ForbidenException($data);
        }
    }
}
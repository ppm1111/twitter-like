<?php

namespace App\Repository;

use App\Models\SharePost;
use App\Domain\Post\Repository\SharePostRepository;

class SharePostRepositoryImpl extends BaseRepositoryImpl implements SharePostRepository
{
    public function __construct(SharePost $model)
    {
        $this->model = $model;
    }

    public function getByUserIdAndPostId($postId, $userId)
    {
        return $this->model
            ->where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();
    }
}
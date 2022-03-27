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

    public function getByUserIdAndPostId($id, $fromUserId, $userId)
    {
        return $this->model
            ->where('post_id', $id)
            ->where('share_user_id', $userId)
            ->where('from_user_id', $fromUserId)
            ->first();
    }
}
<?php

namespace App\Repository;

use App\Models\StarRecord;
use App\Domain\Post\Repository\StarRecordRepository;

class StarRecordRepositoryImpl extends BaseRepositoryImpl implements StarRecordRepository
{
    public function __construct(StarRecord $model)
    {
        $this->model = $model;
    }

    public function getByUserIdAndPostId($userId, $postId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('post_id', $postId)
            ->first();
    }
}
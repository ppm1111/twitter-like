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

    public function getByUserIdAndPostId($id, $userId)
    {
        return $this->model
            ->where('post_id', $id)
            ->where('user_id', $userId)
            ->first();
    }
}
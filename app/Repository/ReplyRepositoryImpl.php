<?php

namespace App\Repository;

use App\Models\Reply;
use App\Domain\Post\Repository\ReplyRepository;

class ReplyRepositoryImpl extends BaseRepositoryImpl implements ReplyRepository
{
    public function __construct(Reply $model)
    {
        $this->model = $model;
    }
}
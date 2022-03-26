<?php

namespace App\Repository;

use App\Models\Post;
use App\Domain\Post\Repository\PostRepository;

class PostRepositoryImpl extends BaseRepositoryImpl implements PostRepository
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getUser()
    {
        return auth('api')->user();
    }
}
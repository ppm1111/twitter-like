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

    public function attachUser($id, $userId)
    {
       $post = $this->model->find($id);
       $post->users()->attach($userId);
    }

    public function getPostFavoredUser($id, $userId)
    {
        $post = $this->model->find($id);
        return $post->users()->where('user_id', $userId)->get();
    }
}
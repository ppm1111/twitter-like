<?php

namespace App\Repository;

use App\Models\User;
use App\Domain\Post\Repository\UserRepository;

class UserRepositoryImpl extends BaseRepositoryImpl implements UserRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function syncUserFollowers($id, $userId)
    {
        $user = $this->model->find($id);
        $user->followers()->attach($userId);
    }
}
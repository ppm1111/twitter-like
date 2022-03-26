<?php

namespace App\Repository;

use App\Domain\Post\Repository\AuthRepository;

class PostAuthRepositoryImpl implements AuthRepository
{
    public function getAuth()
    {
        return auth('api')->user();
    }
}
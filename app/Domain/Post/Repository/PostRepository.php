<?php

namespace App\Domain\Post\Repository;

interface PostRepository
{
    public function attachUser($id, $userId);
}
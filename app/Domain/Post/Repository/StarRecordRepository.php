<?php

namespace App\Domain\Post\Repository;

interface StarRecordRepository
{
    public function getByUserIdAndPostId($userId, $postId);
}
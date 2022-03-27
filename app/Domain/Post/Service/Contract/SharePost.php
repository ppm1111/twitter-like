<?php

namespace App\Domain\Post\Service\Contract;

interface SharePost
{
    public function share($id, $fromUserId, $userId);

    public function checkAlreadyShare($postId, $fromUserId, $userId);
}
<?php

namespace App\Domain\Post\Service\Contract;

interface SharePost
{
    public function share($id, $userId);

    public function checkAlreadyShare($postId, $userId);
}
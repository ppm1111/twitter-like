<?php

namespace App\Domain\Post\Service\Contract;

interface ReplyPost
{
    public function reply($postId, $userId ,$replyText);
}
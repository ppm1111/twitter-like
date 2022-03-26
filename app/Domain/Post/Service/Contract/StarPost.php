<?php

namespace App\Domain\Post\Service\Contract;

interface StarPost
{
    public function star($id);
    
    public function checkAlreadyStar($userId, $postId);
}
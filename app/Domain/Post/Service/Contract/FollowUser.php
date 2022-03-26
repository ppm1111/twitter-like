<?php

namespace App\Domain\Post\Service\Contract;

interface FollowUser
{
    public function follow($id);
}
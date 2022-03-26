<?php

namespace App\Domain\Post\Repository;

interface UserRepository
{
    public function syncUserFollowers($id, $user);
}
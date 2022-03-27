<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\FollowUser;
use App\Domain\Post\Repository\UserRepository;
use App\Exceptions\ForbidenException;

class FollowUserImpl implements FollowUser
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function follow($id, $userId)
    {
        if ($id == $userId) {
            $data = [
                'module' => 'post',
                'errorType' => 'CANNOT_FOLLOW_MYSELF',
            ];
            throw new ForbidenException($data);
        }

        return $this->userRepo->syncUserFollowers($userId, $id);
    }
}
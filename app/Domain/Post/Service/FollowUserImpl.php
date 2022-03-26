<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\FollowUser;
use App\Domain\Post\Repository\UserRepository;
use App\Domain\Post\Repository\AuthRepository;
use App\Exceptions\ForbidenException;

class FollowUserImpl implements FollowUser
{
    private $userRepo;
    private $authRepo;

    public function __construct(
        UserRepository $userRepo,
        AuthRepository $authRepo
        )
    {
        $this->userRepo = $userRepo;
        $this->authRepo = $authRepo;
    }

    public function follow($id)
    {
        $user = $this->authRepo->getAuth();
        if ($id == $user->id) {
            $data = [
                'module' => 'post',
                'errorType' => 'CANNOT_FOLLOW_MYSELF',
            ];
            throw new ForbidenException($data);
        }

        return $this->userRepo->syncUserFollowers($user->id, $id);
    }
}
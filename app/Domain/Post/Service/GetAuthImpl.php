<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\GetAuth;
use App\Domain\Post\Repository\AuthRepository;
use App\Exceptions\ForbidenException;

class GetAuthImpl implements GetAuth
{
    private $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function get()
    {
        return $this->authRepo->getAuth();
    }
}
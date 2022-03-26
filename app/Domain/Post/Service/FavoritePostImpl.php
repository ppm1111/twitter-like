<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\FavoritePost;
use App\Domain\Post\Repository\PostRepository;
use App\Domain\Post\Repository\AuthRepository;

class FavoritePostImpl implements FavoritePost
{
    private $postRepo;
    private $authRepo;

    public function __construct(
        PostRepository $postRepo,
        AuthRepository $authRepo)
    {
        $this->postRepo = $postRepo;
        $this->authRepo = $authRepo;
    }

    public function favorite($id)
    {
        $user = $this->authRepo->getAuth();
        $this->postRepo->attachUser($id, $user->id);
    }
}
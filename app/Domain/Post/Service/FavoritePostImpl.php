<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\FavoritePost;
use App\Domain\Post\Repository\PostRepository;

class FavoritePostImpl implements FavoritePost
{
    private $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function favorite($id, $userId)
    {
        $this->postRepo->attachUser($id, $userId);
    }
}
<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\GetPost;
use App\Domain\Post\Repository\PostRepository;
use App\Exceptions\ForbidenException;

class GetPostImpl implements GetPost
{
    private $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function getById($id)
    {
        return $this->postRepo->getById($id);
    }

    public function getAll()
    {
        return $this->postRepo->getAll();
    }
}
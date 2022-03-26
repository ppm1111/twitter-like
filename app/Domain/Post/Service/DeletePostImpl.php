<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\DeletePost;
use App\Domain\Post\Repository\PostRepository;

class DeletePostImpl implements DeletePost
{
    private $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function delete($id)
    {
        return $this->postRepo->deleteById($id);
    }
}
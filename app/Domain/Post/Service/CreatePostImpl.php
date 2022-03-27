<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\CreatePost;
use App\Domain\Post\Repository\PostRepository;
use App\Domain\Post\Repository\AuthRepository;
use App\Exceptions\ForbidenException;

class CreatePostImpl implements CreatePost
{
    private $postRepo;

    public function __construct(
        PostRepository $postRepo
        )
    {
        $this->postRepo = $postRepo;
    }

    public function create($userId, $text)
    {
        $data = [
            'text' => $text,
            'user_id' => $userId,
            'star' => 0
        ];

        return $this->postRepo->create($data);
    }
}
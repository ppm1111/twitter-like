<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\CreatePost;
use App\Domain\Post\Repository\PostRepository;
use App\Exceptions\ForbidenException;

class CreatePostImpl implements CreatePost
{
    private $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function create($text)
    {
        $user = $this->postRepo->getUser();
        $data = [
            'text' => $text,
            'type' => 'POST',
            'user_id' => $user->id,
            'star' => 0
        ];

        return $this->postRepo->create($data);
    }
}
<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\CreatePost;
use App\Domain\Post\Repository\PostRepository;
use App\Domain\Post\Repository\AuthRepository;
use App\Exceptions\ForbidenException;

class CreatePostImpl implements CreatePost
{
    private $postRepo;
    private $authRepo;

    public function __construct(
        PostRepository $postRepo,
        AuthRepository $authRepo
        )
    {
        $this->postRepo = $postRepo;
        $this->authRepo = $authRepo;
    }

    public function create($text)
    {
        $user = $this->authRepo->getAuth();
        $data = [
            'text' => $text,
            'type' => 'POST',
            'user_id' => $user->id,
            'share_post_id' => null,
            'star' => 0
        ];

        return $this->postRepo->create($data);
    }
}
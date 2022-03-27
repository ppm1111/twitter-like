<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\FavoritePost;
use App\Domain\Post\Repository\PostRepository;
use App\Exceptions\ForbidenException;

class FavoritePostImpl implements FavoritePost
{
    private $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function favorite($id, $userId)
    {
        $check = $this->checkAlreadYFavorite($id, $userId);
        if ($check) {
            $data = [
                'module' => 'post',
                'errorType' => 'ALREADY_FAVORITE',
            ];
            throw new ForbidenException($data);
        }
        $this->postRepo->attachUser($id, $userId);
    }

    public function checkAlreadyFavorite($id, $userId)
    {
        $user = $this->postRepo->getPostFavoredUser($id, $userId);
        
        return $user->count() == 0 ? false : true;
    }
}
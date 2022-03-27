<?php

namespace App\Domain\Post\Service;

use App\Domain\Post\Service\Contract\StarPost;
use App\Domain\Post\Repository\PostRepository;
use App\Domain\Post\Repository\StarRecordRepository;
use App\Domain\Post\Repository\AuthRepository;
use App\Exceptions\ForbidenException;
use DB;

class StarPostImpl implements StarPost
{
    private $postRepo;
    private $authRepo;
    private $starRecordRepo;

    public function __construct(
        PostRepository $postRepo,
        AuthRepository $authRepo,
        StarRecordRepository $starRecordRepo)
    {
        $this->postRepo = $postRepo;
        $this->authRepo = $authRepo;
        $this->starRecordRepo = $starRecordRepo;
    }

    public function star($id, $userId)
    {
        $post = $this->postRepo->getById($id);
        $this->checkAlreadyStar($post->id, $userId);
        $star = intval($post->star) + 1;

        DB::beginTransaction();
        try {
            $this->postRepo->updateById($id, [
                'star' => $star
            ]);

            $data = [
                'user_id' => $userId,
                'post_id' => $post->id,
            ];
            $this->starRecordRepo->create($data);
            DB::commit();
        } catch(\Exceptino $e) {
            DB::rollback();
        }
    }

    public function checkAlreadyStar($id, $userId)
    {
        $record = $this->starRecordRepo->getByUserIdAndPostId($id, $userId);
        if (!empty($record)) {
            $data = [
                'module' => 'post',
                'errorType' => 'POST_ALREADY_STAR',
            ];
            throw new ForbidenException($data);
        }
    }
}
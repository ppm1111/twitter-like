<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\FollowUser as FollowUserService;
use App\Domain\Post\Request\FollowUserRequest;
use App\Http\Resources\SuccessResource;

class FollowUser extends Controller
{
    private $followUserService;

    public function __construct(
        FollowUserService $followUserService)
    {
        $this->followUserService = $followUserService;
    }

    public function __invoke(FollowUserRequest $request)
    {
        $followerId = request()->followerId;
        $this->followUserService->follow($followerId);

        return new SuccessResource(null);
    }
}

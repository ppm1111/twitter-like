<?php

namespace App\Domain\Post\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Post\Service\Contract\FollowUser as FollowUserService;
use App\Domain\Post\Request\FollowUserRequest;
use App\Http\Resources\SuccessResource;
use App\Domain\Post\Service\Contract\GetAuth;

class FollowUser extends Controller
{
    private $followUserService;
    private $getAuthService;

    public function __construct(
        FollowUserService $followUserService,
        GetAuth $getAuthService)
    {
        $this->followUserService = $followUserService;
        $this->getAuthService = $getAuthService;
    }

    public function __invoke(FollowUserRequest $request)
    {
        $followerId = request()->followerId;
        $user = $this->getAuthService->get();
        $this->followUserService->follow($followerId, $user->id);

        return new SuccessResource(null);
    }
}

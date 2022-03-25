<?php

namespace App\Domain\Auth\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Auth\Service\Contract\AuthService;
use App\Http\Resources\SuccessResource;

class Logout extends Controller
{
    private $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke()
    {
        $this->authService->logout();

        return new SuccessResource(null);
    }
}

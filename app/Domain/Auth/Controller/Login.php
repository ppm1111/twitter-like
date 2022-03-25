<?php

namespace App\Domain\Auth\Controller;

use App\Http\Controllers\Controller;
use App\Domain\Auth\Request\LoginRequest;
use App\Domain\Auth\Resource\LoginResource;
use App\Domain\Auth\Service\Contract\AuthService;

class Login extends Controller
{
    private $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke(LoginRequest $request)
    {
        $email = request()->email;
        $password = request()->password;

        $authData = $this->authService->login($email, $password);

        return new LoginResource($authData);
    }
}

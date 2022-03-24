<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Domain\Auth\Service\Contract\AuthService;
use App\Http\Resources\Auth\LoginResource;

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

<?php
namespace App\Domain\Auth\Service;

use App\Domain\Auth\Service\Contract\AuthService;
use App\Domain\Auth\Repository\AuthRepository;
use App\Exceptions\ForbidenException;

class AuthServiceImpl implements AuthService
{

    private $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function login($email, $password)
    {
        $jwtToken = $this->authRepo->checkAuth($email, $password);
        if (!$jwtToken) {
            $data = [
                'module' => 'auth',
                'errorType' => 'AUTH_FAILURE',
            ];
            throw new ForbidenException($data);
        }

        $user = $this->authRepo->getUser();

        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'token_type' => 'Bearer',
            'token' => $jwtToken,
            'expires_in' => auth('api')->factory()->getTTL() * 1 .' mins',
        ];
    }

    public function logout()
    {
        $this->authRepo->logout();
    }
}
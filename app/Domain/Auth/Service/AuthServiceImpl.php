<?php
namespace App\Domain\Auth\Service;

use App\Domain\Auth\Service\Contract\AuthService;
use App\Exceptions\ForbidenException;

class AuthServiceImpl implements AuthService  {

    public function login($email, $password)
    {

        $jwtToken = auth('api')->attempt(['email' => $email, 'password' => $password]);
        if (!$jwtToken) {
            $data = [
                'module' => 'auth',
                'errorType' => 'AUTH_FAILURE',
            ];
            throw new ForbidenException($data);
        }

        $user = auth('api')->user();

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
        auth('api')->logout();
    }
}
<?php
namespace App\Repository;
use App\Domain\Auth\Repository\AuthRepository;

class AuthRepositoryImpl implements AuthRepository
{

    public function checkAuth($email, $password)
    {
        return auth('api')->attempt(['email' => $email, 'password' => $password]);
    }

    public function getUser()
    {
        return auth('api')->user();
    }

    public function logout()
    {
        auth('api')->logout();
    }
}
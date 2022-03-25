<?php

namespace App\Domain\Auth\Service\Contract;

interface AuthService
{

    public function login($email, $password);

    public function logout();
}
<?php

namespace App\Domain\Auth\Repository;

interface AuthRepository
{

    public function checkAuth($email, $password);

    public function getUser();

    public function logout();
}
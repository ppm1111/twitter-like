<?php

namespace App\Domain\Post\Service\Contract;

interface GetPost
{
    public function getById($id);

    public function getAll();
}
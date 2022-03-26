<?php

namespace App\Domain\Post\Service\Contract;

interface CreatePost
{
    public function create($text);
}
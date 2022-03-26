<?php

namespace App\Domain\Post\Service\Contract;

interface FavoritePost
{
    public function favorite($id);
}
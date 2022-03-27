<?php

namespace App\Domain\Post\Service\Contract;

interface StarPost
{
    public function star($id, $userId);
    
    public function checkAlreadyStar($id, $userId);
}
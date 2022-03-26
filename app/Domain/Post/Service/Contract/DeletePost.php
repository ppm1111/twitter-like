<?php

namespace App\Domain\Post\Service\Contract;

interface DeletePost
{
    public function delete($id);
}
<?php

namespace App\Repository;

use App\Domain\Auth\Repository\AuthRepository;

interface BaseRepository
{
    public function getById($id);

    public function getAll();

    public function create($data);

    public function updateById($id, $data);

    public function deleteById($id);
}
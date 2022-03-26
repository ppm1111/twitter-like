<?php

namespace App\Repository;

class BaseRepositoryImpl implements BaseRepository
{
    protected $model;

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function updateById($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function deleteById($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
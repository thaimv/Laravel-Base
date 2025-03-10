<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class AbstractRepository extends BaseRepository
{
    public function firstById($id)
    {
        return $this->model->query()
            ->where('id', $id)
            ->first();
    }
}

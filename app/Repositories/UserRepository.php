<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    public function list($params)
    {
        Helper::pageAndPerPage($params);

        return $this->model
            ->when(isset($params['keyword']), function ($query) use ($params) {
                $query->where(function ($query) use ($params) {
                    $likes = [
                        [
                            ['name', 'email'],
                            'keyword'
                        ]
                    ];
                    $query->whereLike($likes, $params);
                });
            })
            ->paginate($params['per_page'], ['*'], 'page', $params['page']);
    }
}

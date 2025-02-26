<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        public UserRepositoryInterface $userRepository,
    ) { }

    public function list($params)
    {
        $users = $this->userRepository->list($params);

        return UserResource::collection($users);
    }
}

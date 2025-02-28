<?php

namespace App\Services\User;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        public UserRepositoryInterface $userRepository,
    ) { }

    public function list($params)
    {
        return $this->userRepository->list($params);
    }
}

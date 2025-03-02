<?php

namespace App\Repositories;

use App\Models\PasswordResetToken;
use App\Repositories\Interfaces\PasswordResetTokenRepositoryInterface;

class PasswordResetTokenRepository extends AbstractRepository implements PasswordResetTokenRepositoryInterface
{
    public function model()
    {
        return PasswordResetToken::class;
    }

    public function findByEmail($email)
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }

    public function deleteByEmail($email)
    {
        return $this->model
            ->where('email', $email)
            ->delete();
    }
}

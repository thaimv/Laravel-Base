<?php

namespace App\Repositories\Interfaces;

interface PasswordResetTokenRepositoryInterface
{
    public function findByEmail($email);
    public function deleteByEmail($email);
}

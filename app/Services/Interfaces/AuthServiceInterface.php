<?php

namespace App\Services\Interfaces;

interface AuthServiceInterface
{
    public function login($params);
    public function refreshToken();
    public function logout();
    public function forgotPassword($email);
    public function resetPassword($params);
}

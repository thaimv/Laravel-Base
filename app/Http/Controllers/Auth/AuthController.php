<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\JwtAuthResource;
use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * Login
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        try {
            $params = $request->validated();
            $credentials = Arr::only($params, ['email', 'password']);

            if (!$token = Auth::attempt($credentials)) {
                throw new AuthenticationException(__('auth.failed'));
            }

            return $this->responseSuccess(JwtAuthResource::make([
                'access_token' => $token,
                'expires_in' => Auth::factory()->getTTL() * 60,
            ]));
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }

    /**
     * Refresh token
     *
     * @return mixed
     */
    public function refreshToken()
    {
        try {
            return $this->responseSuccess(JwtAuthResource::make([
                'access_token' => Auth::refresh(),
                'expires_in' => Auth::factory()->getTTL() * 60,
            ]));
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }

    /**
     * Get me
     *
     * @return mixed
     */
    public function getMe()
    {
        try {
            return $this->responseSuccess(UserResource::make(Auth::user()));
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }

    /**
     * Logout
     * @return mixed
     */
    public function logout()
    {
        try {
            Auth::logout();

            return $this->responseSuccess([]);
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }
}

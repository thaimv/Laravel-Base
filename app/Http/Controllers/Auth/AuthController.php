<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyTokenRequest;
use App\Http\Resources\JwtAuthResource;
use App\Http\Resources\UserResource;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function __construct(
        public AuthServiceInterface $authService,
    ) {
        //
    }

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
            $data = $this->authService->login($params);

            return $this->responseSuccess(JwtAuthResource::make($data));
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
            $data = $this->authService->refreshToken();

            return $this->responseSuccess(JwtAuthResource::make($data));
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

    /**
     * Forgot password
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->validated();
            $this->authService->forgotPassword($params['email']);
            DB::commit();

            return $this->responseSuccess([]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->handleException($exception);
        }
    }

    /**
     * Verify token
     *
     * @param VerifyTokenRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyToken(VerifyTokenRequest $request)
    {
        try {
            return $this->responseSuccess([]);
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }

    /**
     * Reset password
     *
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->validated();
            $this->authService->resetPassword($params);
            DB::commit();

            return $this->responseSuccess([]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->handleException($exception);
        }
    }
}

<?php

namespace App\Services\Auth;

use App\Helpers\Helper;
use App\Repositories\Interfaces\PasswordResetTokenRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\MailServiceInterface;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        protected PasswordResetTokenRepositoryInterface $passwordResetTokenRepository,
        protected MailServiceInterface $mailService,
        protected UserRepositoryInterface $userRepository,
    ) {
        //
    }

    /**
     * Login
     *
     * @param $params
     * @return array
     * @throws AuthenticationException
     */
    public function login($params)
    {
        $credentials = Arr::only($params, ['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            throw new AuthenticationException(__('validation.auth_incorrect'));
        }

        return Helper::formatTokenInfos($token);
    }

    /**
     * Refresh token
     *
     * @return array
     */
    public function refreshToken()
    {
        return Helper::formatTokenInfos(Auth::refresh());
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }

    /**
     * Forgot password
     * @param $email
     * @return void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function forgotPassword($email)
    {
        $token = $this->passwordResetTokenRepository->findByEmail($email);
        if ($token) {
            $token->update([
                'token' => Hash::make(Str::random(60)),
                'expired_at' => Carbon::now()->addHours(config('common.password_reset_token_expired')),
            ]);
        } else {
            $token = $this->passwordResetTokenRepository->create([
                'email' => $email,
                'token' => Hash::make(Str::random(60)),
                'expired_at' => Carbon::now()->addHours(config('common.password_reset_token_expired')),
            ]);
        }

        // Send email
        $mailInfo = config("common.mail.reset_password");
        $params = 'token=' . urlencode($token->token) . '&email=' . urlencode($email);
        $url = config('common.fe_url') . "/reset-password?{$params}";
        $this->mailService->sendEmail($email, $mailInfo['subject'], $mailInfo['template'], ['url' => $url]);
    }

    /**
     * Reset password
     *
     * @param $params
     * @return void
     */
    public function resetPassword($params)
    {
        $user = $this->userRepository->findByField('email', $params['email'])->first();
        $user->update(['password' => Hash::make($params['password'])]);
        $this->passwordResetTokenRepository->deleteByEmail($params['email']);
    }
}

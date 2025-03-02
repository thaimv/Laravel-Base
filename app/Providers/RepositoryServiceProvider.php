<?php

namespace App\Providers;

use App\Repositories\Interfaces\PasswordResetTokenRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\PasswordResetTokenRepository;
use App\Repositories\UserRepository;
use App\Services\Auth\AuthService;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\MailServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Mail\MailService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MailServiceInterface::class, MailService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(PasswordResetTokenRepositoryInterface::class, PasswordResetTokenRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

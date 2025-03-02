<?php

namespace App\Rules\Auth;

use App\Repositories\PasswordResetTokenRepository;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class VerifyTokenRule implements ValidationRule
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->email) {
            $fail(__('validation.token_invalid'));
        }

        $token = app(PasswordResetTokenRepository::class)->findByEmail($this->email);
        if (!$token || $value != $token->token) {
            $fail(__('validation.token_invalid'));
        } elseif (Carbon::parse($token->expired_at)->lte(Carbon::now())) {
            $fail(__('validation.token_expired'));
        }
    }
}

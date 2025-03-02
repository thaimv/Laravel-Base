<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use App\Rules\Auth\VerifyTokenRule;

class ResetPasswordRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(
            new ForgotPasswordRequest()->rules(),
            [
                'token' => [
                    'required',
                    new VerifyTokenRule($this->email ?? null),
                ],
                'password' => [
                    'bail',
                    'required',
                    'min:8',
                    'max:50',
                ],
                'password_confirmation' => [
                    'bail',
                    'required_with:password',
                    'same:password',
                ]
            ]
        );
    }
}

<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class ListRequest extends BaseRequest
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
        return array_merge([
            'keyword' => 'nullable|string|max:255',
        ], $this->paginateRules());
    }
}

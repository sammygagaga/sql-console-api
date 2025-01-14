<?php

namespace App\Http\Requests\Api\User;

use App\Enums\IsAdmin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreUserRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'is_admin' => ['required', new Enum(IsAdmin::class)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}

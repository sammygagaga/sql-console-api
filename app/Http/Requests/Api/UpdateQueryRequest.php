<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQueryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'query_name' => ['nullable', 'string'],
            'query_text' => ['nullable', 'string'],
        ];
    }
}

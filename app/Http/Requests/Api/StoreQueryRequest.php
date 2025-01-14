<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreQueryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'query_name' => ['required', 'string', 'min:3'],
            'query_text' => ['required', 'string', 'min:3'],
        ];
    }
}

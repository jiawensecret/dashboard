<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\NewFormRequest;

class LoginRequest extends NewFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|between:6,20',
            'password' => 'required|between:6,16',
        ];
    }
}

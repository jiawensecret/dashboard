<?php

namespace App\Http\Requests\Admin;


use App\Http\Requests\NewFormRequest;

class StoreRequest extends NewFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|between:6,20|unique:admins,username',
            'password' => 'required|between:6,16',
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'tel' => 'required|numeric',
        ];
    }

}

<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\NewFormRequest;

class UpdateRequest extends NewFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('admin');

        return [
            'username' => 'required|string|between:6,20|unique:admins,username,'.$id,
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,'.$id,
            'tel' => 'required|numeric',
        ];
    }
    
}

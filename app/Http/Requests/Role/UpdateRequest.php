<?php

namespace App\Http\Requests\Role;

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
        return [
            'name' => 'required|string',
        ];
    }
}

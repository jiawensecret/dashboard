<?php

namespace App\Http\Requests\Permission;

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
            'member_user' => 'required|string',
            'enc_msg' => 'required|string'
        ];
    }
}

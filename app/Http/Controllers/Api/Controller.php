<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $admin;

    public function __construct()
    {
        $this->admin = Auth::guard('api')->user();
    }

    protected function _response($data,$status = 200,$message = '')
    {
        $res = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($res,$status);
    }


}

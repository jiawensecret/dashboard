<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Permission\StoreRequest;
use App\Model\Member;
use App\Model\Person;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    public function store(StoreRequest $storeRequest)
    {
        $member_user = $storeRequest->post('member_user','');

        $enc_msg = $storeRequest->post('enc_msg','');

        $member = Member::where('member_user',$member_user)->first();

        if(!$member) {
            return $this->_response([],403,'该商户不存在或已注销');
        }

        $data = $member->decrypt($enc_msg);
        $data = json_decode($data,true);

        if (!$data['phone']) {
            return $this->_response([],403,'该商户不存在或已注销');
        }

        $person = new Person();
        $person->tel = $data['phone'];
        $person->name = $data['name'] ?? '';
        $person->member_id = $member->id;
        $person->save();
        $person->refresh();

        $http = new Client();

        $xx_token = md5(date('Y-m-d') . '110110');

        $response = $http->post('http://xx.vpbong.cn/api/dc/get_userinfo_token', [
            'form_params' => [
                'mobile' => $person->tel,
                'token' => $xx_token,
            ],
        ]);

        $code = $response->getStatusCode();
        if ($code == '200') {
            $person->status = 1;
            $person->save();
        }


        $res = [
            'member_user' => $member_user,
            'enc_msg' => $member->encrypt(['phone' => $person->tel,'name' => $person->name,'status' => 'success'])
        ];

        return $this->_response($res,200,'成功');


    }

    public function test()
    {
        $data['phone'] = '17715273200';
        $data['name'] = 'test';

        $member = Member::findOrFail(1);

        $res = [
            'member_user' => $member->user,
            'enc_msg' => $member->encrypt($data),
        ];

        echo '加密：</br>';
        print_r($res);

        $data1 = $member->decrypt($res['enc_msg']);

        echo '解密：</br>';
        print_r($data1);

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

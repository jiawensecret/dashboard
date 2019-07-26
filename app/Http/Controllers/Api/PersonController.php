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

        //验签
        if($member->sign($data) != $data['sign']) {
            return $this->_response([],422,'签名错误');
        }

        if (!$data['phone']) {
            return $this->_response([],413,'phone字段不能为空');
        }

        if (!$data['order_no']) {
            return $this->_response([],413,'order_no字段不能为空');
        }

        $person = new Person();
        $person->tel = $data['phone'];
        $person->name = $data['name'] ?? '';
        $person->member_id = $member->id;
        $person->order_no = $data['order_no'] ?? '';
        $person->trade_no = 'tk'.time().substr($data['order_no'],-4);
        $person->save();
        $person->refresh();
dd($person);
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


        $arr = [
            'phone' => $person->tel,
            'name' => $person->name,
            'status' => 'success',
            'order_no' => $person->order_no,
            'trade_no' => $person->trade_no,
            'time' => date('Y-m-d H:i:s',strtotime($person->created_at))
        ];

        $arr['sign'] = $member->sign($arr);

        $res = [
            'member_user' => $member_user,
            'enc_msg' => $member->encrypt($arr)
        ];

        return $this->_response($res,200,'成功');


    }

    public function test()
    {
        $data['phone'] = '17715273200';
        $data['name'] = 'test';
        $data['order_no'] = 'test453522';

        $member = Member::findOrFail(1);
        $data['sign'] = $member->sign($data);

        print_r($data);

        $res = [
            'member_user' => $member->user,
            'enc_msg' => $member->encrypt($data),
        ];

        echo '加密：</br>';
        print_r($res);

        $data1 = $member->decrypt($res['enc_msg']);

        echo '解密：</br>';
        print_r($data1);

        $data1 = json_decode($data1,true);

        $sign = $member->sign($data1);
        echo '签名：';
        echo $sign;

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

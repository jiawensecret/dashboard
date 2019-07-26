<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Member extends Model
{
    protected $pubKey = '';
    protected $priKey = '';

    protected $fillable = [
        'member_user','member_key','public_key','created_at','updated_at'
    ];

    public function encrypt($data, $code = 'hex', $padding = OPENSSL_PKCS1_PADDING)
    {
        if(is_array($data)) $data = json_encode($data);

        if($this->public_key && $contents = Storage::get($this->public_key)) {
            $len = strlen($this->public_key);
            $suffix = substr($this->public_key, $len - 3, $len);
            if ($suffix === "cer") {
                $this->pubKey = openssl_x509_read($contents);
            } else if ($suffix === "pem") {
                $this->pubKey = $contents;
            } else {
                activity()->causedBy($this)->log('读取公钥错误');
                return false;
            }
        }

        $ret = false;
        if (!$this->_checkPadding($padding, 'en')){
            activity()->causedBy($this)->log('加密中填充错误');
            return false;
        }
        if (openssl_public_encrypt($data, $result, $this->pubKey, $padding)) {
            $ret = $this->_encode($result, $code);
        }
        return $ret;



    }

    public function decrypt($data, $code = 'hex', $padding = OPENSSL_PKCS1_PADDING, $rev = false)
    {
        $this->priKey = Storage::get('tk_rsa_private_key.pem');
        echo $this->priKey;

        $data = $this->_decode($data, $code);
        if (!$this->_checkPadding($padding, 'de')) {
            activity()->causedBy($this)->log('解密中填充错误');
            return false;
        }
        if (openssl_private_decrypt($data, $result, $this->priKey, $padding)) {
            $ret = $rev ? rtrim(strrev($result), "\0") : '' . $result;
        }

        return $ret;

    }



    /**
     * 检测填充类型
     * 加密只支持PKCS1_PADDING
     * 解密支持PKCS1_PADDING和NO_PADDING
     *
     * @param int 填充模式
     * @param string 加密en/解密de
     * @return bool
     */
    private function _checkPadding($padding, $type)
    {
        if ($type == 'en') {
            switch ($padding) {
                case OPENSSL_PKCS1_PADDING:
                    $ret = true;
                    break;
                default:
                    $ret = false;
            }
        } else {
            switch ($padding) {
                case OPENSSL_PKCS1_PADDING:
                case OPENSSL_NO_PADDING:
                    $ret = true;
                    break;
                default:
                    $ret = false;
            }
        }
        return $ret;
    }

    private function _encode($data, $code)
    {
        switch (strtolower($code)) {
            case 'base64':
                $data = base64_encode('' . $data);
                break;
            case 'hex':
                $data = bin2hex($data);
                break;
            case 'bin':
            default:
        }
        return $data;
    }

    private function _decode($data, $code)
    {
        switch (strtolower($code)) {
            case 'base64':
                $data = base64_decode($data);
                break;
            case 'hex':
                $data = $this->_hex2bin($data);
                break;
            case 'bin':
            default:
        }
        return $data;
    }

    private function _hex2bin($hex = false)
    {
        $ret = $hex !== false && preg_match('/^[0-9a-fA-F]+$/i', $hex) ? pack("H*", $hex) : false;
        return $ret;
    }

    public function sign($data)
    {
        $data = array_filter($data);
        ksort($data);

        if(isset($data['sign'])) unset($data['sign']);

        $string = '';
        foreach($data as $k => $v) {
            $string .= "{$k}={$v}&";
        }

        $stringTemp = $string . "key=" . $this->member_key;

        return strtoupper(md5($stringTemp));
    }
}

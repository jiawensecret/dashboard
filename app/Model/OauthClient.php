<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    protected $fillable = [
        'user_id','name','secret','password_client','created_at'
    ];
}

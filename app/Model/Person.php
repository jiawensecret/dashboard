<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'tel','name','created_at','updated_at'
    ];


}

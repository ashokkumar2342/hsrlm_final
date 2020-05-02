<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $fillable = ['id',
        'name','user_id','mobile_no', 'password',
    ];

    protected $table ='user_type';

    public $timestamps=false;
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = ['id',
        'name','user_id','mobile_no', 'password',
    ];

    protected $table ='village';

    public $timestamps=false;
}

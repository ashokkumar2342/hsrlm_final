<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['id',
        
    ];

    protected $table ='user_details';

    public $timestamps=false;
}

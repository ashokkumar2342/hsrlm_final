<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['id',
        
    ];

    protected $table ='banks';

    public $timestamps=false;
}

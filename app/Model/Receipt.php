<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['id',
        
    ];

    protected $table ='receipt';

    public $timestamps=false;
}

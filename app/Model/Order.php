<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id',
        
    ];

    protected $table ='orders';

    public $timestamps=false;
}

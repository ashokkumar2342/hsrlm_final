<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['id',
        'name',
    ];

    protected $table ='items';

    public $timestamps=false;
}

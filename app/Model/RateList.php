<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RateList extends Model
{
    protected $fillable = ['id',
        'items_id',
    ];

    protected $table ='rate_list';

    public $timestamps=false;
}

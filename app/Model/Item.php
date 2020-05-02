<?php

namespace App\Model;

use App\Model\Measurement;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['id',
        'name',
    ];

    protected $table ='items';

    public $timestamps=false;

    public function measurements()
    {
    	return $this->hasOne(Measurement::class,'id','measurement_id');
    }
}

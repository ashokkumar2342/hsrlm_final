<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['id',
        
    ];

    protected $table ='transactions';

    // public $timestamps=false;

    public function users()
    {
    	return $this->hasOne('App\User','id','user_id');
    }
    public function Items()
    {
    	return $this->hasOne('App\Model\Item','id','item_id');
    }

}

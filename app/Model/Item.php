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

    public function getItemsByDate($arr,$type='')
    {
    	$query = $this->leftJoin('rate_list','rate_list.items_id','items.id')
    	  ->leftJoin('measurement','measurement.id','items.measurement_id')
    	   
    	  ->selectRaw('items.*,measurement.short_name as measurement,rate_list.*');

    	  if ($type=='date') {
    	  	$query->where('rate_list.for_date',$arr['date']);
    	  	
    	  }
    	  return $query->get();
    	  
    }

}

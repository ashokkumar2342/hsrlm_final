<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VillageFarmerMap extends Model
{
    protected $fillable = ['id',
        'village_shg_id','	farmer_id',
    ];

    protected $table ='vill_shg_farmer_map';

    public $timestamps=false;

    public function Village() {
        
        return $this->hasOne('App\User', 'id', 'village_shg_id');
    }
    public function farmer() {
        
        return $this->hasOne('App\User', 'id', 'farmer_id');
    }
}

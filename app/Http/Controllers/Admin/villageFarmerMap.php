<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class villageFarmerMap extends Model
{
    protected $fillable = ['id',
        'village_shg_id','	farmer_id',
    ];

    protected $table ='vill_shg_farmer_map';

    public $timestamps=false;
}

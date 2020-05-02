<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VillageVenderMap extends Model
{
    protected $fillable = ['id',
        'village_shg_id','	farmer_id',
    ];

    protected $table ='vill_shg_vender_map';

    public $timestamps=false;
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VillageClusterMap extends Model
{
    protected $fillable = ['id',
        'village_shg_id','	farmer_id',
    ];

    protected $table ='vill_shg_cluster_map';

    public $timestamps=false;
}

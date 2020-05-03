<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeliveryClusterMap extends Model
{
    protected $fillable = ['id',
        'delivery_id',
    ];

    protected $table ='delivery_cluster_map';

    public $timestamps=false;
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{ 
    protected $table ='measurement';
    protected $guarded = array();
    public $timestamps=false;
}

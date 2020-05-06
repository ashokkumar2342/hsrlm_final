<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Passbook extends Model
{ 
    protected $table ='passbook';
    protected $guarded = array();
    public $timestamps=false;
}

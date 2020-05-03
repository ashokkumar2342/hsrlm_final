<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $fillable = ['id',
        
    ];

    protected $table ='bank_details';

    public $timestamps=false;
}

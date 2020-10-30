<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintIdLog extends Model
{
    protected $fillable = [
    	'laborer_id',
    	'user_id',
    	'remarks'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laborer extends Model
{
    public function agency()
    {
        return $this->belongsTo('App\Agency')->select('id','agency_name');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryType extends Model
{
    //
    public function agency()
    {
        return $this->belongsTo('App\Agency');
    }
    public function Work()
    {
        return $this->belongsTo('App\Work');
    }
}

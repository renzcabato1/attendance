<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
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
    public function User_info()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}

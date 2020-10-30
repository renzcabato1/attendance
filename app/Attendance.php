<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    public function ApprovedOT()
    {
        return $this->hasOne(Approved_ot::class);
    }
}

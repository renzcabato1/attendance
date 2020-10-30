<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileOt extends Model
{
    //
    public function company_info()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }
    public function department_info()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }
    public function position_info()
    {
        return $this->hasOne(Work::class,'id','work_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generate extends Model
{
    //
    public function companyName()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }
    public function UserInfo()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
    public function AgencyInfo()
    {
        return $this->hasOne(Agency::class,'id','agency_id');
    }
    public function LocationInfo()
    {
        return $this->hasOne(Department::class,'id','location_id');
    }
    public function PositionInfo()
    {
        return $this->hasOne(Work::class,'id','position_id');
    }

}

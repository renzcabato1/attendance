<?php

namespace App;
use App\Attendance;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    public function PositionInfo()
    {
        return $this->hasOne(Work::class,'id','work_id');
    }   
    public function CompanyInfo()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }
    public function LocationInfo()
    {
        return $this->hasOne(Department::class,'id','location_id');
    }
    public function laborer()
    {
        return $this->hasOne(Laborer::class,'id','laborer_id')->select('id','agency_id');
    }
    public function user_info()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
   
    
}

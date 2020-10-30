<?php

namespace App\Http\Controllers;
use App\SalaryType;
use App\Work;
use App\Agency;
use App\Rate;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function payment_view()
    {
        $salaries = SalaryType::with('agency','work')->get();
        $agency = Agency::orderBy('agency_name')->get();
        $positions = Work::orderBy('work_name')->get();
       return view('salary_view',array
       (
           'salaries' => $salaries,
           'agencies' => $agency,
           'positions' => $positions,
       ));
    }
    public function edit_salary(Request $request)
    {
        $salary_update = SalaryType::where('agency_id',$request->agency_id)->where('work_id',$request->work_id)->first();
        $salary_update->basic_salary = $request->basic_salary;
        $salary_update->thirteen_month_salary = $request->thirteen_month_salary;
        $salary_update->sil = $request->sil;
        $salary_update->hazard_pay = $request->hazard_pay;
        $salary_update->ecola = $request->ecola;
        $salary_update->sss = $request->sss;
        $salary_update->ppe = $request->ppe;
        $salary_update->ph = $request->ph;
        $salary_update->hdmf = $request->hdmf;
        $salary_update->ec = $request->ec;
        $salary_update->save();
        $request->session()->flash('status','Successfully Updated ');
        return back();

    }
    public function add_salary (Request $request,$request_id)
    {
        // dd($request->all());
            
            $rate = Rate::findOrfail($request_id);
            // dd($rate);
            $rate->approved_by = auth()->user()->id;
            $rate->remarks = $request->remarks;
            $rate->status = "Approved";
            $rate->save();
            $salary_update = SalaryType::where('agency_id',$rate->agency_id)->where('work_id',$rate->work_id)->where('expiration_date','=',null)->first();
            if($salary_update != null)
            {
                $salary_update->expiration_date = date('Y-m-d');
                $salary_update->save();
            }
            // dd($salary_update);
            $salary = new SalaryType;
            $salary->agency_id = $rate->agency_id;
            $salary->work_id = $rate->work_id;
            $salary->basic_salary = $rate->basic_salary;
            $salary->thirteen_month_salary = $rate->thirteen_month_salary;
            $salary->sil = $rate->sil;
            $salary->hazard_pay = $rate->hazard_pay;
            $salary->ecola = $rate->ecola;
            $salary->sss = $rate->sss;
            $salary->ppe = $rate->ppe;
            $salary->ph = $rate->ph;
            $salary->hdmf = $rate->hdmf;
            $salary->ec = $rate->ec;
            $salary->user_id = auth()->user()->id;
            $salary->save();
            $request->session()->flash('status','Successfully Approved ');
            return back();

    }
    public function new_rate (Request $request)
    {
        // dd($request->all());
            $salary = new Rate;
            $salary->agency_id = $request->agency;
            $salary->work_id = $request->position;
            $salary->basic_salary = $request->basic_salary;
            $salary->thirteen_month_salary = $request->thirteen_month_salary;
            $salary->sil = $request->sil;
            $salary->hazard_pay = $request->hazard_pay;
            $salary->ecola = $request->ecola;
            $salary->sss = $request->sss;
            $salary->ppe = $request->ppe;
            $salary->ph = $request->ph;
            $salary->hdmf = $request->hdmf;
            $salary->ec = $request->ec;
            $salary->user_id = auth()->user()->id;
            $salary->save();
            $request->session()->flash('status','Successfully Submitted. Please contact sir Kiko for Approval of rates.');
            return back();
    }
    public function rate_for_approval (Request $request,$request_id)
    {
        // dd($request->all());
         
    }
    public function for_approval(Request $request)
    {
        $salaries = Rate::where('approved_by',null)->with('agency','work','User_info')->get();
        // dd($salaries);
       return view('rate_views',array
       (
           'salaries' => $salaries,
       ));
         
    }
}

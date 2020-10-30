<?php

namespace App\Http\Controllers;
use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function company_view()
    {
        $companies = Company::get();
        return view('company',array
        (
            'companies' => $companies,
        )); 
    }
    public function new_company(Request $request)
    {
        $this->validate(request(),[
            'company' => 'required|string|max:255',
            ]    
        );
        
        $data = new Company;
        $data->company_name = $request->company;
        $data->save();
        $request->session()->flash('status',$data->name . 'was successfully added ');
        return back();
    }
    public function save_edit_company(Request $request, $id)
    {
        $this->validate(request(),[
            'company' => 'required|max:255',
            ]    
        ); 
        $data =  Company::find($id);
        $data->company_name = $request->input('company');
        $data->save();
        $request->session()->flash('status',$data->name . ' Successfully Changed!');
        return back();
    }
    public function get_data(Request $request)
    {
        $rUrl = 'http://10.96.7.101/FoundWebAPI/api/employee?Email='.$request->Email;
        
        $datas = json_decode(file_get_contents($rUrl), true);
        dd($datas);
    }
}

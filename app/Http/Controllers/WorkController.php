<?php

namespace App\Http\Controllers;
use App\Work;
use App\Discount;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    //
    public function work()
    {
        $positions = Work::leftJoin('discounts','works.status','=','discounts.id')
        ->select('discounts.*','works.*','discounts.id as discount_id')
        ->get();
        
        $discounts_data =  Discount::get();
        return view('view_positions', array(
            'positions' => $positions,
            'discounts_data' => $discounts_data
        )); 
    }
    public function new_position(Request $request)
    {

        $discount = new Work;
        $discount->work_name = $request->position_name;
        $discount->status = $request->status;
        $discount->save();
        $request->session()->flash('status','New Position Added!');
        return back();
    }
    public function edit_position(Request $request,$id)
    {
        $position = Work::findOrfail($id);
        $position->work_name = $request->position_name;
        $position->status = $request->status;
        $position->save();
        $request->session()->flash('status','Successfully Updated');
        return back();
    }
}

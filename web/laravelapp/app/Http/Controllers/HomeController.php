<?php

namespace App\Http\Controllers;
use App\Models\time_table;
use App\Models\club;
use App\Models\time_details;
use App\Models\request_table;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home_view(Request $request){

        if(isset($request->time_id)){
            $time_table = time_table::_id($request->time_id);
        }else{
            $date=date("Y/m/d");
            $time_table = time_table::_date($date)->first();
        }
        $time_details = time_details::_date($time_table->id)->get();
        // $value = time_table::all();
        // $value = club::all();
        // $value = time_details::all();
        // $value = request_table::all();
        // print_r($value->id);
        // $arr = ['Snome1', 'Snome2', 'Snome3'];
          return view('home',compact('time_table','time_details'));
    }
}

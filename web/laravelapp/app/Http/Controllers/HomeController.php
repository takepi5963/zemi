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
        try{
            if(isset($request->time_id)){
                $time_table = time_table::find($request->time_id);
                $time_id=$request->time_id;
            }else{
                $time_table = time_table::orderBy('start_day','desc')->first();
                $time_id = $time_table->id;
            }
            
            $time_table_list = time_table::orderBy('start_day','desc')->get();
            $club_list=club::_club_list();
            $start_end_time=time_details::_time_id($time_id)->_start_end_time(['time_id'=>$time_id]);
            $time_details_list=time_details::_time_details_list($time_id);

            return view('home',compact('time_table','time_table_list','time_details_list','club_list','start_end_time'));
        }catch(\Exception $e){
            $title="Home";
            return view("not_found_time_table",compact('title'));
        }

    }
}

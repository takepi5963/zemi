<?php

namespace App\Http\Controllers;

use App\Models\time_table;
use App\Models\club;
use App\Models\time_details;
use App\Models\request_table;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    //
    public function time_table_view(Request $request){
        $time_table= new time_table;
        return view('time_tables.time_table', compact('time_table'));
    } 
    public function time_table_details(Request $request){
        return view('time_tables.time_table_create');
    } 

    public function time_table_create(Request $request){
        // print_r($request['student_no']);
        $this->validate($request, time_table::$rules);
        $time_table = new time_table;
        $form = $request->all();
        unset($form['_token']);
        unset($form['start_time']);
        unset($form['end_time']);
        $time_table->timestamps = false;    // 追記
        $time_table->fill($form)->save();       
        
        $start_time=$request->start_time;
        $end_time=$request->end_time;
        // echo($time_table->max('id'));
        // print_r($start_time);

        for($cnt=1;$cnt<=$request->time_num;$cnt++){
            echo("test");
            for($week=1;$week<=7;$week++){
                $time_details=new time_details;
                $time_details->time_id=$time_table->max('id');
                $time_details->time_no=$cnt;
                $time_details->week=$week;
                $time_details->start_time=$start_time[$cnt-1];
                $time_details->end_time=$end_time[$cnt-1];
                $time_details->club_id=null;
                $time_details->save();
            }
        }

        return redirect('/time_table');
    } 
}

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
        return view('time_table', compact('time_table'));
    } 
    public function time_table_details(Request $request){
        return view('time_table_create');
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

        for($cnt=1;$cnt<=$request->time_num;$cnt++){
            echo("echo");
        }

        print_r($request->all());


        // return redirect('/home');
    } 
}

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
    public function time_table_create_details(Request $request){
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
    public function time_table_details(Request $request){
        $time_table=time_table::where('id',$request->time_id)->first();
        $time_details=time_details::_date($request->time_id)->get();
        $request_table=request_table::where('time_id',$request->time_id)->first();
        if($request_table==null){   $request_table=new request_table;   }

        return view('time_tables.time_table_details',compact('time_table','time_details','request_table')); 
    }
    
    public function time_table_details_update(Request $request){
        // $time_table=time_table::where('id',$request->time_id)->first();
        // $time_details=time_details::_date($request->time_id)->get();
        // $request_table=request_table::where('time_id',$request->time_id)->first();
        // if($request_table==null){   $request_table=new request_table;   }
        print_r($request->start_time_h);
        try{
            foreach($request->time_details as $time_no=>$time_details_day){
                foreach($time_details_day as $week=>$time_detail){
                    $new=array('club_id'=>$time_detail);
                    $club = time_details::where("time_id",$request->time_id)->where("time_no",$time_no)->where("week",$week)->update($new);
                }
            }
        }catch(\Exception $e){

        }

        for($time_no=1;$time_no<=$request->time_num;$time_no++){
            for($week=1;$week<=7;$week++){
                // print_r($request->start_time[$time_no-1]);
                // print_r($request->end_time[$time_no-1]);
                $new=array('start_time'=>$request->start_time_h[$time_no-1].':'.$request->start_time_m[$time_no-1],'end_time'=>$request->end_time_h[$time_no-1].':'.$request->end_time_h[$time_no-1]);
                print_r($new);
                time_details::where("time_id",$request->time_id)->where("time_no",$time_no)->where("week",$week)->update($new);
            }
        }
        time_table::where("id",$request->time_id)->first()->update(['message'=>$request->message]);
        return redirect('/time_table');
    }

    public function time_table_delete(Request $request){
        $table=time_table::where('id',$request->time_id)->first();
        $table->delete();
        return redirect('/time_table');
    }

}

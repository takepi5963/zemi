<?php

namespace App\Http\Controllers;

use App\Models\time_table;
use App\Models\club;
use App\Models\time_details;
use App\Models\request_table;
use Illuminate\Http\Request;


class RequestController extends Controller
{
    //
    public function request_view(Request $request){
        $value=null;
        //ここのクラブIDを動的なものとする
        $club_id=1;
        try{
            if(isset($request->time_id)){
                $time_table = time_table::_id($request->time_id);
            }else{
                $date=date("Y/m/d");
                $time_table = time_table::orderBy('start_day','desc')->first();
            }
            $time_details = time_details::_date($time_table->id)->get();
            $request_table = new request_table;
            // print_r($request_table);
            return view('requests.request',compact('time_table','time_details','request_table','club_id'));
        }catch(\Exception $e){
            //時間割データがなかった場合
            $title='希望申し込み';
            return view('not_found_time_table',compact('title'));
        }
    }

    public function request_insert(Request $request){
        // print_r($request["time_id"]);
        $this->validate($request,request_table::$rules);
        $request_table = new request_table;
        $form = $request->all();
        unset($form['_token']);
        $request_table->timestamps = false;    // 追記
        $request_table->fill($form)->save();
        return redirect('/request');
    }

    public function request_remove(Request $request){
        request_table::where('time_id',$request->time_id)->where('time_no',$request->time_no)->where('week',$request->week)->where('club_id',$request->club_id)->delete();
        return redirect('/request');
    }
}

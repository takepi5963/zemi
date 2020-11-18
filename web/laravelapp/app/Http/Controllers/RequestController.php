<?php

namespace App\Http\Controllers;

use App\Models\time_table;
use App\Models\club;
use App\Models\time_details;
use App\Models\request_table;
use Illuminate\Http\Request;


class RequestController extends Controller
{
    //希望申し込み状況を確認する
    public function request_view(Request $request){
        $error=null;
        if($request->error=='true'){
            $error='true';
        }

        if('club_leader'!=session()->get('Authority')){
            return redirect('/home');
        }

        $club_id = session()->get('club_id');
        try{
            if(isset($request->time_id)){
                $time_table = time_table::find($request->time_id);
                $time_id=$request->time_id;
            }else{
                $time_table = time_table::orderBy('start_day','desc')->first();
                $time_id = time_table::orderBy('start_day','desc')->first()->id;
            }
            $club_list=club::_club_list();
            $start_end_time=time_details::_time_id($time_id)->_start_end_time(['time_id'=>$time_id]);
            $time_details_list=time_details::_time_details_list($time_id);
            $request_list=request_table::_request_list($time_details_list);
            return view('requests.request',compact('time_table','start_end_time','request_list','time_details_list','club_list','club_id','error'));
        }catch(\Exception $e){
            //時間割データがなかった場合
            $title='希望申し込み';
            return view('not_found_time_table',compact('title','error'));
        }
    }

    //希望申し込み
    public function request_insert(Request $request){
        // print_r($request["time_id"]);
        $request_limit=time_table::find($request->time_id)->request_limit; //希望申し込み上限
        if(request_table::leftjoin('time_details','request.time_details_id','=','time_details.id')->where('time_id',$request->time_id)->where('request.club_id',$request->club_id)->count()>=$request_limit){
            return redirect('/request?error=true');
        }else{
            $this->validate($request,request_table::$rules);
            $request_table = new request_table;
            $form = $request->all();
            unset($form['_token']);
            unset($form['time_id']);
            print_r($form);
            $request_table->fill($form)->save();
            return redirect('/request?error=false');
        }
    }

    //希望申し込み削除
    public function request_remove(Request $request){
        request_table::_time_id($request->time_details_id)->_club_id($request->club_id)->delete();
        return redirect('/request');
    }
}

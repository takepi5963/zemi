<?php

namespace App\Http\Controllers;

use App\Models\time_table;
use App\Models\club;
use App\Models\time_details;
use App\Models\request_table;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    //時間割調整画面表示
    public function time_table_view(Request $request){

        $time_table= time_table::all();
        return view('time_tables.time_table', compact('time_table'));
    } 
    //時間割作成画面表示
    public function time_table_create_details(Request $request){

        return view('time_tables.time_table_create');
    } 
    //時間割詳細画面表示
    public function time_table_details(Request $request){

        $time_table=time_table::find($request->time_id);
        $club_list=club::_club_list();
        $start_end_time=time_details::_time_id($request->time_id)->_start_end_time(['time_id'=>$request->time_id]);
        $time_details_list=time_details::_time_details_list($request->time_id);
        $request_list=request_table::_request_list($time_details_list);
        return view('time_tables.time_table_details',compact('time_table','start_end_time','club_list','request_list')); 
    }

    //時間割データ作成処理
    public function time_table_create(Request $request){
        print_r($request->all());
        $this->validate($request, time_table::$rules);
        $time_table = new time_table;
        $form = $request->all();
        unset($form['_token']);
        unset($form['start_time_h']);
        unset($form['start_time_m']);
        unset($form['end_time_h']);
        unset($form['end_time_m']);
        $time_table->fill($form)->save();       
        
        $start_time_h=$request->start_time_h;
        $start_time_m=$request->start_time_m;
        $end_time_h=$request->end_time_h;
        $end_time_m=$request->end_time_m;

        //時間割詳細レコード作成
        for($cnt=1;$cnt<=$request->time_num;$cnt++){
            for($week=1;$week<=7;$week++){
                $time_details=new time_details;
                $time_details->time_id=$time_table->max('id');
                $time_details->time_no=$cnt;
                $time_details->week=$week;
                $time_details->start_time=$start_time_h[$cnt-1].':'.$start_time_m[$cnt-1];
                $time_details->end_time=$end_time_h[$cnt-1].':'.$end_time_m[$cnt-1];
                $time_details->club_id=null;
                $time_details->save();
            }
        }

        return redirect('/time_table');
    }
    
    //希望決定処理
    public function time_table_details_update(Request $request){
        //サークル決定処理
        try{
            //時間帯ごとのfor文
            foreach($request->time_details as $time_no=>$time_details_no){
                //時間帯&週ごとのfor文
                foreach($time_details_no as $week=>$time_detail_record){
                    $new=array('club_id'=>$time_detail_record);
                    time_details::_time_id($request->time_id)
                    ->_time_no($time_no)
                    ->_week($week)
                    ->update($new);
                }
            }
        }catch(\Exception $e){
            //入力されていない（希望されていない時間）
            echo $e->getMessage();
        }

        //時間割更新
        for($time_no=1;$time_no<=$request->time_num;$time_no++){
            for($week=1;$week<=7;$week++){
                $new=array('start_time'=>$request->start_time_h[$time_no-1].':'.$request->start_time_m[$time_no-1],'end_time'=>$request->end_time_h[$time_no-1].':'.$request->end_time_m[$time_no-1]);
                // print_r($new);
                time_details::_time_id($request->time_id)
                ->_time_no($time_no)
                ->_week($week)
                ->update($new);
            }
        }

        //時間割補足情報更新処理
        $new=['message'=>$request->message];
        time_table::find($request->time_id)->update($new);
        return redirect('/time_table');
    }

        //時間割削除
    public function time_table_delete(Request $request){
        $table=time_table::find($request->time_id);
        $table->delete();
        return redirect('/time_table');
    }

}

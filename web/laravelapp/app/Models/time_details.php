<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\club;

class time_details extends Model
{
    //
    protected $table = 'time_details';
    protected $guarded=array('id');

    public static $rules = array(
        'time_id'=>'required|integer',
        'time_no'=>'required|integer',
        'week'=>'required|integer',
        'start_time'=>'time|required',
        'end_time'=>'time|required',
    );

    public function scope_date($query,$str){
        return $query->where('time_id', '=',$str);
    }
    public function scope_time_id($query,$str){
        return $query->where('time_id', '=',$str);
    }
    public function scope_time_no($query,$str){
        return $query->where('time_no',$str);
    }
    public function scope_week($query,$str){
        return $query->where('week', '=',$str);
    }
    
    //開始時刻と終了時刻を返す関数
    public function scope_start_end_time($query){
        $start_time=array();
        $end_time=array();
        foreach($query->where('week',1)->get() as $result_record){
            array_push($start_time,$result_record['start_time']);
            array_push($end_time,$result_record['end_time']);
        }
        return ['start_time'=>$start_time,'end_time'=>$end_time];
    }

    //time_idをもとにidをリスト化して返す
    public function scope_time_details_list($query,$str){
        $result=array();
        for($time_cnt=1;$time_cnt<=time_table::find($str)->time_num;$time_cnt++){
            $result_record=array();
            for($week_cnt=1;$week_cnt<=7;$week_cnt++){
                $result_record[$week_cnt]=time_details::_time_id($str)->_time_no($time_cnt)->_week($week_cnt)->first();
            }
            $result[$time_cnt]=$result_record;
        }
        return $result;
    }
    
}

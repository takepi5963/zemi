<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\request_table;
use App\Models\time_table;

class request_table extends Model
{
    //
    protected $table = 'request';
    protected $guarded=array('id');

    public static $rules = array(
        'time_details_id'=>'required|integer',
        'club_id'=>'required|integer'
    );

    public function scope_time_id($query,$str){
        return $query->where('time_details_id', '=',$str);
    }

    public function scope_club_id($query,$str){
        return $query->where('club_id', '=',$str);
    }

    //どの時間帯にどのくらい希望が出されているのかをリストにして返す
    public function scope_request_list($query,$time_details_list){
        $result=array();
        foreach($time_details_list as $index=>$time_details_list_record){
            $result_record=array();
            foreach($time_details_list_record as $index_detail=>$time_details_id){
                $result_record[$index_detail]=request_table::_time_id($time_details_id->id)->get();
            }
            $result[$index]=$result_record;
        }
        return $result;
    }

    public function array_request($time_id,$time_no,$week,$club_id){
        return request_table::where('time_id',$time_id)->where('time_no',$time_no)->where('week',$week)->where('club_id','!=',$club_id)->get();
    }
    
}

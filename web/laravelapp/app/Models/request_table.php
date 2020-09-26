<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\request_table;

class request_table extends Model
{
    //
    protected $table = 'request_table';
    protected $fillable = ['time_id', 'time_no' , 'week' , 'club_id'];

    public static $rules = array(
        'time_id'=>'required|integer',
        'time_no'=>'required|integer',
        'week'=>'required|integer',
        'club_id'=>'required|integer'
    );

    public function scope_request_time_id($query,$str){
        return $query->where('time_id', '<=',$str);
    }
    public function scope_request_time_no($query,$str){
        return $query->where('time_no', '=',$str);
    }
    public function scope_request_week($query,$str){
        return $query->where('week', '=',$str);
    }
    public function scope_request_club_id($query,$str){
        return $query->where('club_id', '=',$str);
    }

    public function bool_request($time_id,$time_no,$week,$club_id){

        if(null==request_table::where('time_id',$time_id)->where('time_no',$time_no)->where('week',$week)->where('club_id',$club_id)->first()){
            return true;
        }else{
            return false;
        }
    }
    public function array_request($time_id,$time_no,$week,$club_id){
        return request_table::where('time_id',$time_id)->where('time_no',$time_no)->where('week',$week)->where('club_id','!=',$club_id)->get();
    }
    
}

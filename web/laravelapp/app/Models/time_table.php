<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class time_table extends Model
{
    //
    protected $table = 'time';
    protected $guarded=array('id');

    public static $rules = array(
        'time_num'=>'required|integer',
        'start_day'=>'date|required',
        'end_day'=>'date|required',
        'message'=>'nullable|string',
        'request_limit'=>'integer|required',
        'start_time_h.*'=>'required',
        'start_time_m.*'=>'required',
        'end_time_h.*'=>'required',
        'end_time_m.*'=>'required'

    );

    public function scope_id($query,$str){
        return $query->where('id', '=',$str)->first();
    }
    //date期間中のレコードを検索する
    public function scope_date($query,$str){
        return $query->where('start_day', '<=',$str)->where('end_day', '>=',$str);
    }
    
    public function scope_start_date($query,$str){
        return $query->where('start_day', '=>',$str);
    }
    
    public function scope_end_date($query,$str){
        return $query->where('end_day', '<',$str);
    }
}

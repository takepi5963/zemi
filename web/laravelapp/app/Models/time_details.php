<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\club;

class time_details extends Model
{
    //
    protected $table = 'time_details';

    public static $rules = array(
        'time_num'=>'required|integer',
        'start_day'=>'date|required',
        'end_day'=>'date|required',
        'message'=>'string|required'
    );

    public function scope_date($query,$str){
        return $query->where('time_id', '=',$str);
    }

    public function club_name($str){
        return club::where('id',$str)->first()->club_name;
    }
}

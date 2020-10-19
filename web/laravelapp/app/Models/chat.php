<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\chat;
use App\Models\club;

class chat extends Model
{
    //
    protected $table = 'chat';
    protected $guarded= array('id');
    public $timestamps = false;
    protected $fillable = [
        'time_id', 'time_no', 'week','club_id','message','chat_time'
    ];

    public function club_name($str){
        return club::where('id',$str)->first()->club_name;
    }
}

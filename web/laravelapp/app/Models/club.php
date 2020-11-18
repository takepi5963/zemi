<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class club extends Model
{
    //
    protected $table = 'club';
    protected $guarded= array('id');

    public static $rules = array(
        'club_name'=>'required|string',
        'student_no'=>'required|integer'
    );

    //学籍番号からサークルを検索する
    public function scope_student_no($query,$str){
        $query->where('student_no',$str);
    }

    //IDとサークル名を返す
    public function scope_club_list($query){
        $result=array();
        foreach($query->get() as $club_record){
            $result+=array($club_record->id=>$club_record->club_name);
        }
        return $result;
    }

}

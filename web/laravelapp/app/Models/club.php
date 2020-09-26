<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class club extends Model
{
    //
    protected $table = 'club';
    protected $guarded= array('id');

    public static $rules = array(
        'club_name'=>'required',
        'student_no'=>'integer'
    );

}

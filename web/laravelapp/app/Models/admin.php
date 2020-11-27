<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    //
    protected $table = 'admin';
    public $timestamps = false;
    protected $fillable = [
        'login_id',
    ];
 
    public static $rules = array(
        'login_id'=>'required|string|max:20',
    );

    public function scope_admin($query,$str){
        $query->where('login_id',$str);
    }
}

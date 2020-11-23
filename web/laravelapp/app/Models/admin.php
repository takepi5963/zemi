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
        'password'
    ];
 
    public static $rules = array(
        'login_id'=>'required|string',
        'password'=>'required|string'
    );

    public function scope_admin($query,$str){
        $query->where('login_id',$str['id'])->where('password',$str['pass']);
    }
}

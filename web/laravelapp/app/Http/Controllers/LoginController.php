<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; //追記
use App\Models\club;
use App\Models\admin;

class LoginController extends Controller
{
    //ログイン処理
    public function login (Request $request, Response $response)
    {
        if(admin::_admin($request)->first()!=null){
            session()->put(['Authority'=>'admin']);
        }else{
            if(substr($request->id,0,1)=='s'){
                $request->id=substr($request->id,1,strlen($request->id)-1);
            }
            try{
                $club_id=club::_student_no($request->id)->first()->id;
                session()->put(['Authority'=>'club_leader','club_id'=>$club_id]);
            }catch(\Exception $e){
                session()->put(['Authority'=>'user']);
            }
        }
        return redirect('/home');
    }
    //ログアウト処理
    public function logout(Request $request, Response $response){
        session()->flush();
        return redirect('/login');
    }
}

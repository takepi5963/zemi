<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; //追記
use App\Models\club;

class LoginController extends Controller
{
    //
    public function login (Request $request, Response $response)
    {
        if(substr($request->id,0,1)=='t'){
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
    public function logout(Request $request, Response $response){
        session()->flush();
        return redirect('/login');
    }
}

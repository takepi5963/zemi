<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\admin;
use App\Models\club;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!($request->session()->exists('Authority'))) {
            //セッションの保存方法を考え直す$_SESSIONとかに保存してみる
            // print($_SESSION['Authority']);
            $login_id='admin';// login_idにSSOのログインIDを代入してください
            if(admin::_admin($login_id)->first()!=null){
                session()->put(['Authority'=>'admin']);
            }else{
                if(substr($login_id,0,1)=='s'){
                    $login_id=substr($login_id,1,strlen($login_id)-1);
                }
                try{
                    $club_id=club::_student_no($login_id)->first()->id;
                    session()->put(['Authority'=>'club_leader','club_id'=>$club_id]);
                }catch(\Exception $e){
                    session()->put(['Authority'=>'user']);
                }
            }
        }   
        return $next($request);
    }
}

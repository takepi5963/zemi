<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;

class AdminController extends Controller
{
    //
    public function admin_view(){
        $validate_flg=false;
        return view('/admin',compact('validate_flg'));
    }
    public function admin_update(Request $request){
        $this->validate($request, admin::$rules);
        $admin = admin::first();
        $form = $request->all();
        unset($form['_token']);
        $admin->timestamps = false;    // 追記
        $admin->fill($form)->save();
        $validate_flg=true;
        return view('/admin',compact('validate_flg')); //変更
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;

class AdminController extends Controller
{
    //
    public function admin_view(){
        if('admin'!=session()->get('Authority')){
            return redirect('/home');
        }
        return view('/admin');
    }
    public function admin_update(Request $request){
        $this->validate($request, admin::$rules);
        $admin = admin::first();
        $form = $request->all();
        unset($form['_token']);
        $admin->timestamps = false;    // 追記
        $admin->fill($form)->save();
        return redirect('/admin'); //変更
    }
}

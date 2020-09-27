<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time_table;
use App\Models\club;
use App\Models\time_details;
use App\Models\request_table;

class ClubController extends Controller
{
    //
    public function club_view(){
        $club=club::all();
        // print_r($club);
        return view('clubs.club',compact('club'));
    }
    public function club_insert(Request $request){
        // print_r($request['student_no']);
        $this->validate($request, club::$rules);
        $club = new club;
        $form = $request->all();
        unset($form['_token']);
        $club->timestamps = false;    // 追記
        $club->fill($form)->save();
        return redirect('/club');
    }
    public function club_details(Request $request){
        $club=club::find($request->id);
        return view('clubs.club_details',compact('club'));
    }
    public function club_remove(Request $request){
        club::find($request->id)->delete();
        return redirect('/club');
    }

    public function club_update(Request $request){
        // print_r($request['student_no']);
        $this->validate($request, club::$rules);
        $club = club::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $club->timestamps = false;    // 追記
        $club->fill($form)->save();
        return redirect('/club');
    }

}

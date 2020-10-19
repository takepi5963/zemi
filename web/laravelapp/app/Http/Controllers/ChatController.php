<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time_table;
use App\Models\club;
use App\Models\time_details;
use App\Models\request_table;
use App\Models\chat;

class ChatController extends Controller
{
    public function chat_view(Request $request){
        $time_id=$request->time_id;
        $time_no=$request->time_no;
        $week=$request->week;
        $chat=chat::where('time_id',$time_id)->where('time_no',$time_no)->where('week',$week)->get();
        $club = new chat();
        return view('/chat',compact('time_id','time_no','week','chat','club'));
    }
    public function chat_insert(Request $request){
        $club_id=1;
        $chat = new chat();
        $chat->create([
            'time_id'=>$request->time_id,
            'time_no'=>$request->time_no,
            'week'=>$request->week,
            'club_id'=>$club_id,
            'message'=>$request->message,
            'chat_time'=>date("Y-m-d H:i:s")
            ]);
        return redirect()->route('chat',$request->all());
    } 
}

@extends('layouts.tmp')
@section('title','掲示板')
@section('main')
@foreach ($chat as $chat_record)
    <div>
        <p class="user_info">{{$club->club_name($chat_record->club_id)}}代表者</p>
        <p class="message">{{$chat_record->message}}</p>
        <hr>
    </div>
@endforeach
    <form action="/chat" class="fixed-bottom form-group form-inline" method="POST">
        @csrf
        <input type="text"  class="form-control w-75" placeholder="メッセージを入力してください" name="message">
        <input type="hidden" name="time_id" value="{{$time_id}}">
        <input type="hidden" name="time_no" value="{{$time_no}}">
        <input type="hidden" name="week" value="{{$week}}">
        <input type="submit"  class="btn btn-secondary" name="送信">
    </form>
@endsection
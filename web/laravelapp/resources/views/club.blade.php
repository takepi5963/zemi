@extends('layouts.tmp')
@section('title','サークル管理')
@section('main')
<form action="/club/create" method="get">
<table class="table-bordered">
    <tr><th>サークル名</th><th><input name="club_name" type="text"></th></tr>
    <tr><th>代表者学籍番号</th><th><input name="student_no" type="text"></th></tr>
    <tr><th></th><th><input type="submit" value="作成"></th></tr>
</table>
</form>
<hr>
<ul>
    @foreach($club as $club_one)
    <li>
    <form action="/club/details" method="get">
        {{$club_one->club_name}}<input type="submit" value="設定">
        <input type="hidden" name="id" value="{{$club_one->id}}">
    </form>
    </li>
        @endforeach
</ul>

@endsection
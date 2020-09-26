@extends('layouts.tmp')
@section('title','サークル管理')
@section('main')
<form action="/club/update" method="post">
    <input type="hidden" name="id" value="{{$club->id}}">
    <table class="table-bordered">
        @csrf
        <tr><th>サークルID</th><th>{{$club->id}}</th></tr>
        <tr><th>サークル名</th><th><input type="text" name="club_name" value="{{$club->club_name}}"></th></tr>
        <tr><th>代表者学籍番号</th><th><input type="text" name="student_no" value="{{$club->student_no}}"></th></tr>
        <tr><th></th><th><input type="submit" value="更新"></th></tr>
    </table>
</form>
<hr>
<form action="/club/delete" method="post">
    <input type="hidden" name="id" value="{{$club->id}}">
        @csrf
        <input type="submit" value="削除">
</form>

@endsection
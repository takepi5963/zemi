@extends('layouts.tmp')
@section('title','サークル管理')
@section('main')

@foreach ($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach


<form action="/club/create" method="get">
<table class="table-bordered">
    <tr><th>サークル名</th><th><input name="club_name" type="text"></th></tr>
    <tr><th>代表者学籍番号</th><th><input name="student_no" type="text"></th></tr>
    <tr><th></th><th><input type="submit" class="btn btn-secondary" value="作成"></th></tr>
</table>
</form>
<hr>
<table class="club">
    @foreach($club as $club_one)
    <form action="/club/details" method="get">
        <tr><td>{{$club_one->club_name}}</td>
        <td><input type="submit" value="設定" class="btn btn-secondary"></td></tr>
        <input type="hidden" name="id" value="{{$club_one->id}}">
    </form>
        @endforeach
</table>
@endsection
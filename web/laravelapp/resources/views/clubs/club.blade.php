@extends('layouts.tmp')
@section('main')

<main>
<h1>サークル管理</h1>
<form action="/club/create" method="get">
<table class="table-bordered">
    <tr><th>サークル名</th><th><input name="club_name" type="text"></th></tr>
    <tr><th>代表者学籍番号</th><th><input name="student_no" type="text"></th></tr>
    <tr><th></th><th><input type="submit" value="作成"></th></tr>
</table>
</form>
<hr>
<table class="club">
    @foreach($club as $club_one)
    <form action="/club/details" method="get">
        <tr><td>{{$club_one->club_name}}</td>
        <td><input type="submit" value="設定"></td></tr>
        <input type="hidden" name="id" value="{{$club_one->id}}">
    </form>
        @endforeach
</table>
</main>

@endsection
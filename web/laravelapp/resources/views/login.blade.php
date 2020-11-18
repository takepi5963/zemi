@extends('layouts.tmp')
@section('title','')
@section('main')
<div class="login_page">
    <form action="/login/check" class="form-signin" method="post">
        {{ csrf_field() }}
        <p>sign in</p>
        <p>
            <input type="text" placeholder="学籍番号" class="form-control" name="id">
        </p>
        <p>
            <input type="password" placeholder="パスワード" class="form-control" name="pass">
        </p>
        <input type="submit" class="form-control">
    </form>
</div>
@endsection
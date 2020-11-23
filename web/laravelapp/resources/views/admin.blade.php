@extends('layouts.tmp')
@section('title','管理者情報更新')
@section('main')
<div class="login_page">
    <form action="/admin" class="form-signin" method="post">
        {{ csrf_field() }}
        <br>
        <p>
            <input type="text" placeholder="新しいID" class="form-control" name="login_id">
        </p>
        <p>
            <input type="password" placeholder="新しいパスワード" class="form-control" name="password">
        </p>
        <input type="submit" value="更新" class="btn btn-primary">
    </form>
</div>
@endsection
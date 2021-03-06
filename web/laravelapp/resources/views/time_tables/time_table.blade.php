@extends('layouts.tmp')
@section('title','時間割調整画面')
@section('main')

<table class="table-bordered">
    <thead>
        <tr class="table-secondary">
            <th scope="col text-nowrap">時間割ID</th>
            <th scope="col text-nowrap">開始日付</th>
            <th scope="col text-nowrap">終了日付</th>
            <th scope="col text-nowrap"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($time_table as $time_table_record)
    <tr>
        <td class="text-nowrap">{{$time_table_record->id}}</td>
        <td class="text-nowrap">{{$time_table_record->start_day}}</td>
        <td class="text-nowrap">{{$time_table_record->end_day}}</td>
        <td class="text-nowrap">
            <form action="/time_table/details" method="get">
                <input type="hidden" name="time_id" value="{{$time_table_record->id}}">
                <input type="submit" value="詳細" class="btn btn-secondary" name="" id="">
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<hr>
<form action="/time_table/create" method="get">
    <input type="submit" value="時間割作成" class="btn btn-secondary">
</form>
@endsection
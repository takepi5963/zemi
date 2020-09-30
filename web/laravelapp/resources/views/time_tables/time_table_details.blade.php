@extends('layouts.tmp')
@section('title','希望申し込み')
@section('main')
<p>期間 {{$time_table->start_day}} ～ {{$time_table->end_day}}</p>

<form action="/time_table/details" method="post">
    <input type="hidden" name="time_id" value="{{$time_table->id}}">
    @csrf
    <table class="table table-bordered" style="table-layout: fixed;">
        <thead>
            <tr class="table-secondary">
                <th scope="col text-nowrap">#</th>
                <th scope="col text-nowrap">日</th>
                <th scope="col text-nowrap">月</th>
                <th scope="col text-nowrap">火</th>
                <th scope="col text-nowrap">水</th>
                <th scope="col text-nowrap">木</th>
                <th scope="col text-nowrap">金</th>
                <th scope="col text-nowrap">土</th>
            </tr>
        </thead>
        <tbody>
            @for($time_cnt=1;$time_cnt<=$time_table->time_num;$time_cnt=$time_cnt+1)
            <tr>
                <th scope="row">
                    {{$time_details->where("time_no",$time_cnt)->first()->start_time}}
                    ～ 
                    {{$time_details->where("time_no",$time_cnt)->first()->end_time}}
                </th>
                @for($week_cnt=1;$week_cnt<=7;$week_cnt=$week_cnt+1)
                <td class="text-nowrap">
                    @foreach($request_table->where("time_id",$time_table->id)->where("time_no",$time_cnt)->where("week",$week_cnt)->get() as $request_record)
                    <p>
                        <input type="radio" name="time_details[{{$time_cnt}}][{{$week_cnt }}]" value="{{$request_record->club_id}}">
                        <label for="time_details[{{$time_cnt}}][{{$week_cnt }}]">{{$time_details[0]->club_name($request_record->club_id)}}</label>
                    </p>
                    @endforeach
                </td>          
                @endfor  
            </tr>
            @endfor
        </tbody>
    </table>
    <input type="text" class="text-left border" name="message" value="{{ $time_table->message }}">
    <input type="submit">
</form>
    @endsection
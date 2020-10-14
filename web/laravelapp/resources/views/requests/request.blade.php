@extends('layouts.tmp')
@section('title','希望申し込み')
@section('main')
<p>期間 
<form action="/request" method="get" onchange="submit(this.form);">
    <select name="time_id" id="">
        @foreach($time_table->all() as $time_table_record)
            @if($time_table->id == $time_table_record->id)
            <option value="{{$time_table_record->id}}" selected>{{ $time_table_record->start_day }} ~ {{ $time_table_record->end_day }}</option>
            @else
            <option value="{{$time_table_record->id}}">{{ $time_table_record->start_day }} ~ {{ $time_table_record->end_day }}</option>
            @endif
        @endforeach
    </select>
</form>
</p>

<div class="scroll">
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
        <?php
             foreach($time_details as $time_detail){    
                 if($time_cnt==$time_detail->time_no){
                     echo($time_detail->start_time." ～ ".$time_detail->end_time);
                    break;
                }
            }
             ?>
        </th>
        @for($week_cnt=1;$week_cnt<=7;$week_cnt=$week_cnt+1)
        <td class="text-nowrap">
        <ul class="list-group" style="max-width: 400px;">
            @foreach($request_table->array_request($time_table->id,$time_cnt,$week_cnt,$club_id) as $request)
                        <li class="list-group-item">{{$time_detail->club_name($request->club_id)}}</li>
            @endforeach
            <li class="list-group-item">
        @if($request_table->bool_request($time_table->id,$time_cnt,$week_cnt,$club_id))
            <form action="request/insert">
            <input type="hidden" name="time_id" value="{{$time_table->id}}">
            <input type="hidden" name="time_no" value="{{$time_cnt}}">
            <input type="hidden" name="week" value="{{$week_cnt}}">
            <input type="hidden" name="club_id" value="{{$club_id}}">
            <input type="submit" class="btn btn-dark mt-1" value="申し込み" name="" id="">
            </form>
        @else
            <form action="request/delete">
            <input type="hidden" name="time_id" value="{{$time_table->id}}">
            <input type="hidden" name="time_no" value="{{$time_cnt}}">
            <input type="hidden" name="week" value="{{$week_cnt}}">
            <input type="hidden" name="club_id" value="{{$club_id}}">
            <input type="submit" class="btn btn-outline-dark mt-1" value="申し込み解除" name="" id="">
            </form>
        @endif
            </li>
        </ul>
        </td>          
        @endfor  
    </tr>
    @endfor
</tbody>
</table>
</div>
<p class="text-left border">{{ $time_table->message }}</p>                 
@endsection

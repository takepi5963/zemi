@extends('layouts.tmp')
@section('title','Home')
@section('main')
<p>期間
    <form action="/home" method="get" onchange="submit(this.form);">
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
                @foreach($time_details as $time_detail)
                    @if($time_cnt==$time_detail->time_no&&$week_cnt==$time_detail->week)
                        @if($time_detail->club_id!=null)
                            {{$time_detail->club_name($time_detail->club_id)}}
                        @endif
                    @endif
                @endforeach
            </td>          
            @endfor        
        </tr>
        @endfor
        <tr>
            <td>補足情報</td>
            <td colspan='7'>{{ $time_table->message }}</td>
        </tr>
    </tbody>
    </table>
</div>     
@endsection
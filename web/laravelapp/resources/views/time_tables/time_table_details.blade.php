@extends('layouts.tmp')
@section('title','希望申し込み')
@section('main')
<p>期間 {{$time_table->start_day}} ～ {{$time_table->end_day}}</p>

<form action="/time_table/details" method="post">
    <input type="hidden" name="time_id" value="{{$time_table->id}}">
    @csrf
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
                <select name="start_time_h[]" id="selectedate-h">
                <?php
                try{
                    $start_h=explode(":",$time_details->where("time_no",$time_cnt)->first()->start_time)[0];
                }catch(Exception $e){
                    $start_h=array(0,0);
                }
                try{
                    $start_m=explode(":",$time_details->where("time_no",$time_cnt)->first()->start_time)[1];
                }catch(Exception $e){
                    $start_m=array(0,0);
                }
                ?>
                    @for($h=0;$h<24;$h++)
                        @if($h==$start_h)
                        <option selected value="{{$h}}">{{$h}}</option>
                        @else
                        <option value="{{$h}}">{{$h}}</option>
                        @endif
                    @endfor
                </select>
                <select name="start_time_m[]" id="selectedate-m">
                    @for($m=0;$m<60;$m++)
                        @if($m==$start_m)
                            <option selected value="{{$m}}">{{$m}}</option>
                        @else
                            <option value="{{$m}}">{{$m}}</option>
                        @endif
                    @endfor
                </select>
                    ～
                <select name="end_time_h[]" id="selectedate-h">
                <?php
                    try{
                        $end_h=explode(":",$time_details->where("time_no",$time_cnt)->first()->end_time)[0];
                    }catch(Exception $e){
                        $end_h=array(0,0);
                    }
                    try{
                        $end_m=explode(":",$time_details->where("time_no",$time_cnt)->first()->end_time)[1];
                    }catch(Exception $e){
                        $end_m=array(0,0);
                    }
                ?>
                    @for($h=0;$h<24;$h++)
                        @if($h==$end_h)
                        <option selected value="{{$h}}">{{$h}}</option>
                        @else
                        <option value="{{$h}}">{{$h}}</option>
                        @endif
                    @endfor
                </select>
                <select name="end_time_m[]" id="selectedate-m">
                    @for($m=0;$m<60;$m++)
                        @if($m==$end_m)
                            <option selected value="{{$m}}">{{$m}}</option>
                        @else
                            <option value="{{$m}}">{{$m}}</option>
                        @endif
                    @endfor
                </select>
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
            <tr>
                <td>補足情報</td>
                <td colspan='7'>
                    <input type="text" class="form-control text-left border" name="message" value="{{ $time_table->message }}" maxlength="10000">
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    <input type="hidden" name="time_num" value="{{ $time_table->time_num }}">
    <input type="submit" class="btn btn-secondary" value="変更">
</form>
    @endsection

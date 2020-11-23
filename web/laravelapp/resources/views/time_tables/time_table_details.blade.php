@extends('layouts.tmp')
@section('title','時間割詳細画面')
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
            {{--時間の数だけ繰り返す--}}
            @for($time_cnt=1;$time_cnt<=$time_table->time_num;$time_cnt=$time_cnt+1)
            <tr>
                <th scope="row">
                <?php
                try{
                    //開始時間を代入
                    $start_h=explode(":",$start_end_time['start_time'][$time_cnt-1])[0];
                }catch(Exception $e){
                    $start_h=array(0,0);
                }
                try{
                    //開始分を代入
                    $start_m=explode(":",$start_end_time['start_time'][$time_cnt-1])[1];
                }catch(Exception $e){
                    $start_m=array(0,0);
                }
                ?>
                {{--デフォルトの値の設定（時間）--}}
                <select name="start_time_h[]" id="selectedate-h">
                    @for($h=5;$h<23;$h++)
                    @if($h==$start_h)
                    <option selected value="{{$h}}">{{$h}}</option>
                    @else
                    <option value="{{$h}}">{{$h}}</option>
                    @endif
                    @endfor
                </select>
                {{--デフォルトの値の設定（分）--}}
                <select name="start_time_m[]" id="selectedate-m">
                    @for($m=0;$m<60;$m+=10)
                    @if($m==$start_m)
                    <option selected value="{{$m}}">{{$m}}</option>
                    @else
                    <option value="{{$m}}">{{$m}}</option>
                    @endif
                    @endfor
                </select>
                ～
                <?php
                    try{
                        //終了時間を代入
                        $end_h=explode(":",$start_end_time['end_time'][$time_cnt-1])[0];
                    }catch(Exception $e){
                        $end_h=array(0,0);
                    }
                    try{
                        //終了分を代入
                        $end_m=explode(":",$start_end_time['end_time'][$time_cnt-1])[1];
                    }catch(Exception $e){
                        $end_m=array(0,0);
                    }
                    ?>
                {{--デフォルトの値の設定（時間）--}}
                <select name="end_time_h[]" id="selectedate-h">
                    @for($h=5;$h<23;$h++)
                    @if($h==$end_h)
                    <option selected value="{{$h}}">{{$h}}</option>
                    @else
                    <option value="{{$h}}">{{$h}}</option>
                    @endif
                    @endfor
                </select>
                {{--デフォルトの値の設定（分）--}}
                <select name="end_time_m[]" id="selectedate-m">
                    @for($m=0;$m<60;$m+=10)
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
                    @if (count($request_list[$time_cnt][$week_cnt])>0)
                    @foreach($request_list[$time_cnt][$week_cnt] as $request_record)
                    <p>
                        <input type="radio" name="time_details[{{$time_cnt}}][{{$week_cnt }}]" value="{{$request_record->club_id}}">
                        <label for="time_details[{{$time_cnt}}][{{$week_cnt }}]">{{$club_list[$request_record->club_id]}}</label>
                    </p>
                    @endforeach
                    @else
                    <p class="null"></p>
                    @endif
                </td>          
                @endfor  
            </tr>
            @endfor
            <tr>
                <td>補足情報</td>
                <td colspan='7' >
                    <textarea type="text"  class="message" class="form-control text-left border" name="message" rows='10' maxlength="10000">{{ $time_table->message }}</textarea>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    <input type="hidden" name="time_num" value="{{ $time_table->time_num }}">
    <input type="submit" class="btn btn-secondary" value="変更">
</form>
<hr>
<form action="/time_table/details/delete">
    <input type="submit" value="削除" class="btn btn-danger">
    <input type="hidden" value="{{$time_table->id}}" name="time_id">
</form>
    @endsection

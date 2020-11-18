@extends('layouts.tmp')
@section('title','希望申し込み')
@section('main')
<p>期間 
<form action="/request" method="get" onchange="submit(this.form);">
    @if($error=='true')
        <p class="text-danger"> 申し込みが上限を超えています。</p>
    @endif
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
            {{date('H:i', strtotime($start_end_time['start_time'][$time_cnt-1]))}}～{{date('H:i', strtotime($start_end_time['end_time'][$time_cnt-1]))}}
        </th>
        @for($week_cnt=1;$week_cnt<=7;$week_cnt=$week_cnt+1)
        <td class="text-nowrap">
        <ul class="list-group" style="max-width: 400px;">
            <?php $applied_flg=false; ?>
            @foreach($request_list[$time_cnt][$week_cnt] as $request_record)
                        <li class="list-group-item">{{$club_list[$request_record->club_id]}}</li>
                        @if ($club_id==$request_record->club_id)
                            <?php $applied_flg=true; ?>
                        @endif
            @endforeach
            <li class="list-group-item">
        @if($applied_flg)
            <form action="request/delete">
                <input type="hidden" name="time_details_id" value="{{$time_details_list[$time_cnt][$week_cnt]->id}}">
                <input type="hidden" name="time_id" value="{{$time_table->id}}">
                <input type="hidden" name="club_id" value="{{$club_id}}">
                <input type="submit" class="btn btn-outline-dark mt-1" value="申し込み解除" name="" id="">
            </form>
            @else
            <form action="request/insert">
                <input type="hidden" name="time_details_id" value="{{$time_details_list[$time_cnt][$week_cnt]->id}}">
                <input type="hidden" name="time_id" value="{{$time_table->id}}">
                <input type="hidden" name="club_id" value="{{$club_id}}">
                <input type="submit" class="btn btn-dark mt-1" value="申し込み" name="" id="">
            </form>
        @endif
            </li>
        </ul>
        </td>          
        @endfor  
    </tr>
    @endfor
    <tr>
        <td>補足情報</td>
        <td colspan='7' class="message">{{ $time_table->message }}</td>
    </tr>
</tbody>
</table>
</div>
@endsection

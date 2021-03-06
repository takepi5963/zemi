@extends('layouts.tmp')
@section('title','時間割作成画面')
@section('main')

@foreach ($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach

<form action="/time_table/create" method="post">
@csrf

    <div class="col-sm-3">
    <label for="time_num" class="text-nowrap">一日当たりの時間数:</label>
    <input type="number" min="1" name="time_num" id="time_num" value="4" class="form-control d-inline">
    </div>
    <div class="col-sm-3">
    <label for="request_limit" class="text-nowrap">希望申し込みの上限:</label>
    <input type="number" min="1" name="request_limit" id="request_limit" value="5" class="form-control d-inline">
    </div>

        <div class="col-sm-5">
            <label for="start_day">開始日付:</label>
            <input type="date" name="start_day" id="start_day" placeholder="YYYYMMDD" class="form-control d-inline">
        </div>
        <div class="col-sm-5">
            <label for="end_day">終了日付:</label>
            <input type="date" name="end_day" id="end_day" placeholder="YYYYMMDD" class="form-control d-inline">
        </div>

<div class="col-sm">
<label for="exampleFormControlTextarea1">補足説明:</label>
<textarea maxlength="100000" name="message" id="exampleFormControlTextarea1" class="form-control message" rows="10" wrap="hard"></textarea>
</div>

<input type="button" value="確定" class="btn btn-secondary" id="create_button">

<hr>
<div id="time_list"></div>
</form>

<script type="text/javascript">
    document.getElementById("create_button").onclick = function() {
        const time_num = document.getElementById("time_num").value;
        let html_text="";
        for(let i=0;i<time_num;i++){
            html_text+=
            '<p>'+
            (i+1)+'枠目：'+
            '開始時刻'+
            '<select name="start_time_h[]">'
            @for($h=5;$h<22;$h++)
                +'<option value="{{$h}}">{{$h}}</option>'
            @endfor
            +'</select>：'
            +'<select name="start_time_m[]">'
            @for($m=0;$m<60;$m+=10)
                +'<option value="{{$m}}">{{$m}}</option>'
            @endfor
            +'</select>'
            +' ~ 終了時刻'
            +'<select name="end_time_h[]">'
            @for($h=5;$h<22;$h++)
                +'<option value="{{$h}}">{{$h}}</option>'
            @endfor
            +'</select>：'
            +'<select name="end_time_m[]">'
            @for($m=0;$m<60;$m+=10)
                +'<option value="{{$m}}">{{$m}}</option>'
            @endfor
            +'</select>'
            +'</p>';
        }
        time_list.innerHTML=html_text+
        '<input type="submit" class="btn btn-secondary" value="作成">';
        // alert(html_text);
    };
</script>
@endsection
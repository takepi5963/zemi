@extends('layouts.tmp')
@section('title','時間割作成画面')
@section('main')
<form action="/time_table/create" method="post">
@csrf

<div class="col-sm">
<label for="time_num">一日当たりの枠数:</label>
<input type="number" min="1" name="time_num" id="time_num" class="form-control">
</div>

<div class="col-sm">

<label for="start_day">開始日付:</label>
<input type="date" name="start_day" id="start_day" class="form-control">

<label for="end_day">終了日付:</label>
<input type="date" name="end_day" id="end_day" class="form-control">
</div>

<div class="col-sm">
<label for="exampleFormControlTextarea1">補足説明:</label>
<textarea maxlength="100000" name="message" id="exampleFormControlTextarea1" class="form-control class="message"" rows="10"></textarea>
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
            '開始時刻<input type="time" name="start_time[]">'+
            ' ~ 終了時刻<input type="time" name="end_time[]">'+
            '</p>';
        }
        time_list.innerHTML=html_text+
        '<input type="submit" class="btn btn-secondary" value="作成">';
        // alert(html_text);
    };
</script>
@endsection
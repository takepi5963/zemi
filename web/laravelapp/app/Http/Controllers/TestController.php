<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\time_table;
use App\Models\club;
use App\Models\time_details;
use App\Models\request_table;

class TestController extends Controller
{
    //
    public function func() {
      $value=null;
      $date='20200515';
      $value = time_table::_date($date)->get();

      // $value = time_table::all();
      // $value = club::all();
      // $value = time_details::all();
      // $value = request_table::all();
      print_r($value);
      $arr = ['Snome1', 'Snome2', 'Snome3'];
        return view('sample',compact('value','arr'));
      }
}

<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\TestMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () { return view('login');});

Route::post('/login/check', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/admin', 'AdminController@admin_view');
Route::post('/admin', 'AdminController@admin_update');

Route::get('/home', 'HomeController@home_view');
Route::get('/', 'HomeController@home_view');

Route::get('/chat', 'ChatController@chat_view')->name('chat');
Route::post('/chat', 'ChatController@chat_insert');

Route::get('/time_table','TimeTableController@time_table_view');
Route::get('/time_table/details','TimeTableController@time_table_details');
Route::get('/time_table/details/delete','TimeTableController@time_table_delete');
Route::post('/time_table/details','TimeTableController@time_table_details_update');
Route::get('/time_table/create','TimeTableController@time_table_create_details');
Route::post('/time_table/create','TimeTableController@time_table_create');

Route::get('/request', 'RequestController@request_view');
Route::get('/request/insert', 'RequestController@request_insert');
Route::get('/request/delete', 'RequestController@request_remove');

Route::get('/club', 'ClubController@club_view');
Route::get('/club/create', 'ClubController@club_insert');

Route::get('/club/details', 'ClubController@club_details');
Route::post('/club/delete', 'ClubController@club_remove');
Route::post('/club/update', 'ClubController@club_update');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LoginMiddleware;

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

Route::get('/home', 'HomeController@home_view');
Route::get('/', 'HomeController@home_view');

Route::get('/admin', 'AdminController@admin_view')->middleware(LoginMiddleware::class);
Route::post('/admin', 'AdminController@admin_update')->middleware(LoginMiddleware::class);


Route::get('/time_table','TimeTableController@time_table_view')->middleware(LoginMiddleware::class);
Route::get('/time_table/details','TimeTableController@time_table_details')->middleware(LoginMiddleware::class);
Route::get('/time_table/details/delete','TimeTableController@time_table_delete')->middleware(LoginMiddleware::class);
Route::post('/time_table/details','TimeTableController@time_table_details_update')->middleware(LoginMiddleware::class);
Route::get('/time_table/create','TimeTableController@time_table_create_details')->middleware(LoginMiddleware::class);
Route::post('/time_table/create','TimeTableController@time_table_create')->middleware(LoginMiddleware::class);

Route::get('/request', 'RequestController@request_view')->middleware(LoginMiddleware::class);
Route::get('/request/insert', 'RequestController@request_insert')->middleware(LoginMiddleware::class);
Route::get('/request/delete', 'RequestController@request_remove')->middleware(LoginMiddleware::class);

Route::get('/club', 'ClubController@club_view')->middleware(LoginMiddleware::class);
Route::get('/club/create', 'ClubController@club_insert')->middleware(LoginMiddleware::class);

Route::get('/club/details', 'ClubController@club_details')->middleware(LoginMiddleware::class);
Route::post('/club/delete', 'ClubController@club_remove')->middleware(LoginMiddleware::class);
Route::post('/club/update', 'ClubController@club_update')->middleware(LoginMiddleware::class);
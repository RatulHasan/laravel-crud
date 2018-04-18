<?php

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


Route::get('/','AdminController@crud');
Route::post('/get_table_name','AdminController@get_table_name');
Route::post('/save_crud','AdminController@saveCrud');

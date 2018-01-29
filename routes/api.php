<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/holidays', 'APIsController@holiday');

Route::get('/events', 'APIsController@event');

Route::get('/placements/{year}/{branch}', 'APIsController@placement');

Route::get('/announcements/{year}/{branch}', 'APIsController@announcement');
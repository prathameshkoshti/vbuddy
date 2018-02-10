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

Route::get('/login/{email}/{password}', 'APIsController@login');

Route::get('/holidays', 'APIsController@holiday');

Route::get('/events/{commitee}', 'APIsController@event');

Route::get('/placements/{year}/{branch}', 'APIsController@placement');

Route::get('/placements/{year}/{branch}/{id}', 'APIsController@placementView');

Route::get('/announcements/{year}/{branch}/{div}', 'APIsController@announcement');

Route::get('/announcements/{year}/{branch}/{div}/{id}', 'APIsController@announcementView');

Route::get('/events/{year}/{branch}/{commitee}', 'APIsController@event');

Route::get('/events_registration/{event_id}/{student_id}', 'APIsController@registerToEvent');
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
    /*
        Routes for Users i.e. Faculties
    */
    Route::prefix('users')->group(function(){
        Route::get('/', 'UsersController@index');
    });
    /*
        Routes for Students 
    */
    /*
        Routes for Placement Announcements 
    */
    /*
        Routes for Faculty Announcemnets 
    */
    /*
        Routes for Feedback 
    */
    /*
        Routes for Events 
    */
    /*
        Routes for Event's Enrollments 
    */
    /*
        Routes for Holidays 
    */
    Route::prefix('holidays')->group(function(){
        Route::get('/', 'HolidaysController@index');

        Route::get('create', 'HolidaysController@create');
        Route::put('store', 'HolidaysController@store');

        Route::get('edit/{id}', 'HolidaysController@edit');
        Route::put('update/{id}', 'HolidaysController@update');

        Route::get('delete/{id}', 'HolidaysController@destroy');

    });
    /*
        Routes for holidays 
    */
    /*
        Routes for holidays 
    */
    
});



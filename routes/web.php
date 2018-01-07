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
        Routes for Users i.e. Faculties and other users
    */
    Route::prefix('users')->group(function(){
        Route::get('/', 'UsersController@index');
        
        Route::get('create', 'UsersController@create');
        Route::put('store', 'UsersController@store');

        Route::get('edit/{id}', 'UsersController@edit');
        Route::put('update/{id}', 'UsersController@update');

        Route::get('delete/{id}', 'UsersController@destroy');
        
    });
    /*
        Routes for Students 
    */
    Route::prefix('students')->group(function(){
        Route::get('/', 'StudentsController@index');
        
        Route::get('create', 'StudentsController@create');
        Route::put('store', 'StudentsController@store');

        Route::get('edit/{id}', 'StudentsController@edit');
        Route::put('update/{id}', 'StudentsController@update');

        Route::get('delete/{id}', 'StudentsController@destroy');
        
    });
    /*
        Routes for Placement Announcements 
    */
    Route::prefix('placements')->group(function(){
        Route::get('/', 'PlacementsController@index');

        Route::get('create', 'PlacementsController@create');
        Route::put('store', 'PlacementsController@store');

        Route::get('edit/{id}', 'PlacementsController@edit');
        Route::put('update/{id}', 'PlacementsController@update');

        Route::get('delete/{id}', 'PlacementsController@destroy');
    });
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



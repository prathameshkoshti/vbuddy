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

Route::get('404', function(){
    return view('errors.404');
});

Route::get('401', function(){
    return view('errors.401');
});

Auth::routes();


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
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
    Route::prefix('faculty_announcements')->group(function(){
        Route::get('/', 'AnnouncementsController@index');

        Route::get('create', 'AnnouncementsController@create');
        Route::put('store', 'AnnouncementsController@store');

        Route::get('edit/{id}', 'AnnouncementsController@edit');
        Route::put('update/{id}', 'AnnouncementsController@update');

        Route::get('delete/{id}', 'AnnouncementsController@destroy');
    });
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
        Route for Profile 
    */
    Route::prefix('profile')->group(function(){
        Route::get('/', 'ProfilesController@profile');
        Route::put('/update', 'ProfilesController@update');

        Route::get('/change_password', 'ProfilesController@changePassword');
        Route::put('/update_password', 'ProfilesController@updatePassword');
    });
    
});

Route::group(['prefix' => 'faculty', 'middleware' => 'faculty'], function(){
    
    Route::get('/home','FacultiesController@home');

    Route::prefix('faculty_announcements')->group(function(){
        Route::get('/', 'FacultiesController@announcmentsHome');

        Route::get('/index', 'FacultiesController@announcmentsIndex');

        Route::get('create', 'FacultiesController@announcementsCreate');
        Route::get('store', 'FacultiesController@announcementsStore');

        Route::get('edit/{id}', 'FacultiesController@announcementsEdit');
        Route::get('update/{id}', 'FacultiesController@announcementsUpdate');

        Route::get('delete/{id}', 'FacultiesController@announcementsDestroy');
    });

    Route::prefix('placements')->group(function(){
        Route::get('/', 'FacultiesController@placementsHome');

        Route::get('/index', 'FacultiesController@placementsIndex');

        Route::get('create', 'FacultiesController@placementsCreate');
        Route::get('store', 'FacultiesController@placementsStore');

        Route::get('edit/{id}', 'FacultiesController@placementsEdit');
        Route::get('update/{id}', 'FacultiesController@placementsUpdate');

        Route::get('delete/{id}', 'FacultiesController@placementsDestroy');
    });

});
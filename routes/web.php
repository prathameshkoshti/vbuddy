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
    Route::prefix('feedbacks')->group(function(){
        Route::view('/', 'admin.feedbacks.home');
        Route::put('index', 'FeedbacksController@index');
        Route::get('view/{id}', 'FeedbacksController@show');
    });

    /*
       Routes for timetable
   */
    Route::prefix('timetable')->group(function(){
        Route::get('/', 'TimetablesController@index');
        Route::get('view/{branch}/{semester}/{div}','TimetablesController@view');
    });

    /*
        Routes for IA Timetable 
    */
    Route::prefix('ia_timetable')->group(function(){
        Route::get('/', 'IATimetablesController@index');
        Route::get('view/{branch}/{id}', 'IATimetablesController@view');
        Route::get('edit/{id}','IATimetablesController@edit');
        Route::put('update/{id}','IATimetablesController@update');
    });

    /*
        Routes for Events 
    */
    Route::prefix('events')->group(function(){
        Route::get('/', 'EventsController@index');

        Route::get('view/{id}   ', 'EventsController@show');

        Route::get('create', 'EventsController@create');
        Route::put('store', 'EventsController@store');

        Route::get('edit/{id}', 'EventsController@edit');
        Route::put('update/{id}', 'EventsController@update');

        Route::get('delete/{id}', 'EventsController@destroy');
    });

    /*
        Routes for Event's Enrollments 
    */
    Route::prefix('event_registrations')->group(function(){
        Route::get('/', 'EventRegistrationsController@index');

        Route::get('view/{id}', 'EventRegistrationsController@show');
    });

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
        Route::get('/', 'FacultiesController@announcementsHome');

        Route::get('index', 'FacultiesController@announcementsIndex');

        Route::get('create', 'FacultiesController@announcementsCreate');
        Route::put('store', 'FacultiesController@announcementsStore');

        Route::get('edit/{id}', 'FacultiesController@announcementsEdit');
        Route::put('update/{id}', 'FacultiesController@announcementsUpdate');

        Route::get('delete/{id}', 'FacultiesController@announcementsDestroy');
    });

    Route::prefix('placements')->group(function(){
        Route::get('/', 'FacultiesController@placementsHome');

        Route::get('index', 'FacultiesController@placementsIndex');

        Route::get('create', 'FacultiesController@placementsCreate');
        Route::put('store', 'FacultiesController@placementsStore');

        Route::get('edit/{id}', 'FacultiesController@placementsEdit');
        Route::put('update/{id}', 'FacultiesController@placementsUpdate');

        Route::get('delete/{id}', 'FacultiesController@placementsDestroy');
    });

    Route::prefix('events')->group(function(){
        Route::view('/', 'faculty.events.home');

        Route::get('index', 'FacultiesController@eventsIndex');

        Route::get('view/{id}', 'FacultiesController@eventsShow');

        Route::view('create', 'faculty.events.create');
        Route::put('store', 'FacultiesController@eventsStore');

        Route::get('edit/{id}', 'FacultiesController@eventsEdit');
        Route::put('update/{id}', 'FacultiesController@eventsUpdate');

        Route::get('delete/{id}', 'FacultiesController@eventsDestroy');
    });

    Route::prefix('event_registrations')->group(function(){
        Route::view('/', 'faculty.events.home');

        Route::get('index', 'FacultiesController@eventRegistrationsIndex');

        Route::get('create', 'FacultiesController@eventRegistrationsCreate');
        Route::put('store', 'FacultiesController@eventRegistrationsStore');

        Route::get('edit/{id}', 'FacultiesController@eventRegistrationsEdit');
        Route::put('update/{id}', 'FacultiesController@eventRegistrationsUpdate');

        Route::get('delete/{id}', 'FacultiesController@eventRegistrationsDestroy');
    });

    Route::prefix('profile')->group(function(){
        Route::get('/', 'ProfilesController@facultyProfile');
        Route::put('update', 'ProfilesController@facultyProfileUpdate');

        Route::get('change_password', 'ProfilesController@facultyChangePassword');
        Route::put('update_password', 'ProfilesController@facultyUpdatePassword');
    });

    /*
       Routes for IA Timetable
   */

    Route::prefix('ia_timetables')->group(function(){
        Route::get('/', 'IATimetablesController@findex');
        Route::get('view/{branch}/{id}', 'IATimetablesController@fview');
        Route::get('edit/{id}','IATimetablesController@fedit');
        Route::put('update/{id}','IATimetablesController@fupdate');
    });


});
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

Route::prefix('student')->group(function(){
    Route::get('login', 'Auth\StudentLoginController@showLoginForm');
    Route::post('login', 'Auth\StudentLoginController@login');

    Route::get('home', 'StudentController@index');
    Route::post('logout', 'Auth\StudentLoginController@studentLogout');

    Route::get('holidays', 'StudentController@holiday');
    Route::get('timetable', 'StudentController@timetable');
    Route::get('ia_timetable', 'StudentController@iaTimetable');

    Route::prefix('faculty_announcements')->group(function(){
        Route::get('/', 'StudentController@announcement');
        Route::get('view/{id}', 'StudentController@announcementView');
        Route::get('download/{id}/{file_name}', 'StudentController@announcementDownload');        
    });

    Route::prefix('placements')->group(function(){
        Route::get('/', 'StudentController@placement');
        Route::get('view/{id}', 'StudentController@placementView');
        Route::get('download/{id}/{file_name}', 'StudentController@placementDownload');
        Route::get('register/{id}', 'StudentController@registerToPlacement');
    });

    Route::prefix('events')->group(function(){
        Route::get('', 'StudentController@event');
        Route::get('view/{id}', 'StudentController@eventView');
        Route::get('download/{id}/{file_name}', 'StudentController@EventDownload');
        Route::get('enroll/{id}', 'StudentController@enrolToEvent');
    });

    Route::prefix('profile')->group(function(){
        Route::get('', 'StudentController@profile');
        Route::get('change_password', 'StudentController@changePassword');
        Route::put('update_password', 'StudentController@updatePassword');
    });

    Route::prefix('feedback')->group(function(){
        Route::get('/', 'StudentController@feedback');
        Route::put('store', 'StudentController@storeFeedback');
    });

});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    /*
        Routes for Users i.e. Faculties and other users
    */
    Route::prefix('users')->group(function(){
        Route::get('/', 'UsersController@index');
        Route::get('view/{id}', 'UsersController@show');

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
        Route::get('view/{id}', 'StudentsController@show');

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
        Route::get('view/{id}', 'PlacementsController@show');

        Route::get('create', 'PlacementsController@create');
        Route::put('store', 'PlacementsController@store');
        Route::get('download/{id}/{file_name}', 'PlacementsController@download');

        Route::get('edit/{id}', 'PlacementsController@edit');
        Route::put('update/{id}', 'PlacementsController@update');

        Route::get('delete/{id}', 'PlacementsController@destroy');
    });

    Route::prefix('placement_registrations')->group(function(){
        Route::get('/', 'PlacementRegistrationsController@index');

        Route::get('view/{id}', 'PlacementRegistrationsController@show');
    });
    /*
        Routes for Faculty Announcemnets
    */
    Route::prefix('faculty_announcements')->group(function(){
        Route::get('/', 'AnnouncementsController@index');        
        Route::get('view/{id}', 'AnnouncementsController@show');

        Route::get('download/{id}/{file_name}', 'AnnouncementsController@download');

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

        Route::get('statistics', 'FeedbacksController@stats');
    });

    /*
       Routes for timetable
   */
    Route::prefix('timetable')->group(function(){
        Route::get('/', 'TimetablesController@index');
        Route::get('view/{branch}/{semester}/{div}','TimetablesController@view');
        Route::get('view/edit/{branch}/{semester}/{div}','TimetablesController@view_edit')->name('view_edit');

        Route::get('/edit/{id}','TimetablesController@edit');
        Route::put('update/{id}','TimetablesController@update');

    });

    /*
        Routes for Replacement Timetable
    */
    Route::prefix('replacement_timetables')->group(function(){
        Route::get('/', 'ReplacementTimetablesController@index');
        
        Route::put('make_replacement', 'ReplacementTimetablesController@makeReplacement');
        Route::get('create/{day}/{date}/{sem}/{branch}/{div}/{subject}', 'ReplacementTimetablesController@create');
        Route::put('store', 'ReplacementTimetablesController@store');
        
        Route::get('edit/{id}', 'ReplacementTimetablesController@edit');
        Route::put('update/{id}', 'ReplacementTimetablesController@update');

        Route::get('delete/{id}', 'ReplacementTimetablesController@destroy');        
    });

    /*
        Routes for IA Timetable
    */
    Route::prefix('ia_timetables')->group(function(){
        Route::get('/', 'IATimetablesController@index');
        Route::get('view/{branch}/{sem}', 'IATimetablesController@view');
        Route::get('edit/{id}','IATimetablesController@edit');
        Route::put('update/{id}','IATimetablesController@update');
    });

    /*
        Routes for Events
    */
    Route::prefix('events')->group(function(){
        Route::get('/', 'EventsController@index');
        Route::get('view/{id}', 'EventsController@show');

        Route::get('download/{id}/{file_name}', 'EventsController@download');
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

    /*
    Route for settings
*/
    Route::prefix('settings')->group(function(){
        Route::get('/','SettingsController@index');
        Route::put('/promote_sem','SettingsController@promote_sem');
        Route::put('/promote_year','SettingsController@promote_year');
        Route::put('/demote_sem','SettingsController@demote_sem');
        Route::put('/demote_year','SettingsController@demote_year');
        Route::put('/reset','SettingsController@reset');
    });
    
});

Route::group(['prefix' => 'faculty', 'middleware' => 'faculty'], function(){

    Route::get('/home','FacultiesController@home');

    Route::prefix('faculty_announcements')->group(function(){
        Route::get('/', 'FacultiesController@announcementsHome');

        Route::get('index', 'FacultiesController@announcementsIndex');
        Route::get('view/{id}', 'FacultiesController@announcementsShow');
        
        Route::get('download/{id}/{file_name}', 'FacultiesController@announcementsDownload');

        Route::get('create', 'FacultiesController@announcementsCreate');
        Route::put('store', 'FacultiesController@announcementsStore');

        Route::get('edit/{id}', 'FacultiesController@announcementsEdit');
        Route::put('update/{id}', 'FacultiesController@announcementsUpdate');

        Route::get('delete/{id}', 'FacultiesController@announcementsDestroy');
    });

    Route::prefix('placements')->group(function(){
        Route::get('/', 'FacultiesController@placementsHome')->middleware('placement_coordinator');

        Route::get('index', 'FacultiesController@placementsIndex');
        Route::get('view/{id}', 'FacultiesController@placementsShow');

        Route::get('download/{id}/{file_name}', 'FacultiesController@placementsDownload');        

        Route::get('create', 'FacultiesController@placementsCreate')->middleware('placement_coordinator');
        Route::put('store', 'FacultiesController@placementsStore')->middleware('placement_coordinator');

        Route::get('edit/{id}', 'FacultiesController@placementsEdit')->middleware('placement_coordinator');
        Route::put('update/{id}', 'FacultiesController@placementsUpdate')->middleware('placement_coordinator');

        Route::get('delete/{id}', 'FacultiesController@placementsDestroy')->middleware('placement_coordinator');
    });

    Route::prefix('placement_registrations')->group(function(){
        Route::get('', 'FacultiesController@placementRegistrationsIndex')->middleware('placement_coordinator');
        Route::get('view/{id}', 'FacultiesController@placementRegistrationsShow')->middleware('placement_coordinator');
    });

    Route::prefix('events')->group(function(){
        Route::view('/', 'faculty.events.home')->middleware('event_coordinator');

        Route::get('index', 'FacultiesController@eventsIndex');
        Route::get('view/{id}', 'FacultiesController@eventsShow');
        
        Route::get('download/{id}/{file_name}', 'FacultiesController@eventsDownload');        

        Route::view('create', 'faculty.events.create')->middleware('event_coordinator');
        Route::put('store', 'FacultiesController@eventsStore')->middleware('event_coordinator');

        Route::get('edit/{id}', 'FacultiesController@eventsEdit')->middleware('event_coordinator');
        Route::put('update/{id}', 'FacultiesController@eventsUpdate')->middleware('event_coordinator');

        Route::get('delete/{id}', 'FacultiesController@eventsDestroy')->middleware('event_coordinator');
    });

    Route::prefix('event_registrations')->group(function(){
        Route::get('', 'FacultiesController@eventRegistrationsIndex')->middleware('event_coordinator');
        Route::get('view/{id}', 'FacultiesController@eventRegistrationsShow')->middleware('event_coordinator');
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
        
        Route::get('view/{branch}/{id}', 'IATimetablesController@fview')->name('view_faculty_ia_timetable');
        
        Route::get('edit/{id}','IATimetablesController@fedit')->middleware('exam_coordinator');
        Route::put('update/{id}','IATimetablesController@fupdate')->middleware('exam_coordinator');
    });


});
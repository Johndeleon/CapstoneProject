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

Auth::routes();
Route::get('/', function () {
    return redirect('/admin/dashboard');
});

Route::group(['middleware' => 'App\Http\Middleware\AccessLevel2Middleware'], function()
{

    Route::group(['middleware' => 'App\Http\Middleware\AccessLevel1Middleware'], function()
    {
        Route::get('/admin/programs','HomeController@showPrograms')->name('showprograms');
        /* LISTS OF ALL PROGRAMS */
        // @created by John @since Nov4, @updated by John @since Nov4

        Route::get('/admin/program/{title}/{i}','HomeController@showProgram')->name('showprogram');
        /* FOR SINGLE VIEW ONLY */
        // @created by John @since Nov5, @updated by John @since Nov5

        Route::post('/admin/addprogram','HomeController@addProgram')->name('addProgram');
        // @created by John @since Nov5, @updated by John @since Nov5

        Route::post('/editprogram/{id}','HomeController@editProgram')->name('editprogram');
        // @created by John @since Nov8, @updated by John @since Nov8

        Route::get('admin/deleteprogram/{id}','HomeController@deleteProgram')->name('deleteprogram');
        // @created by John @since Nov7, @updated by John @since Nov7

        Route::get('/admin/courses','HomeController@showCourses')->name('showcourses');
        // @created by John @since Nov9, @updated by John @since Nov9

        Route::post('/editcourse/{id}','HomeController@editCourse')->name('editcourse');
        // @created by John @since Nov10, @updated by John @since Nov10

        Route::get('/deletecourse/{id}','HomeController@deleteCourse')->name('deletecourse');
        // @created by John @since Nov10, @updated by John @since Nov10

        Route::post('/admin/addcourse','HomeController@addCourse')->name('addcourse');
        // @created by John @since Nov11, @updated by John @since Nov11

        Route::get('/course/{code}','HomeController@showCourse')->name('showcourse');
        // @created by John @since Nov13, @updated by John @since Nov13

        /* HAS BEEN CHANGED AT KENNETH'S CONTROLLER */
        // Route::get('/admin/teachers','HomeController@showTeachers')->name('showteachers');
        // @created by John @since Nov11, @updated by John @since Nov11

        Route::post('/addteacher','HomeController@addTeacher')->name('addteacher');
        // @created by John @since Nov12, @updated by John @since Nov12

        Route::post('/editteacher/{id}','HomeController@editTeacher')->name('editteacher');
        // @created by John @since Nov12, @updated by John @since Nov12

        Route::get('/deleteteacher/{id}','HomeController@deleteTeacher')->name('deleteteacher');
        // @created by John @since Nov12, @updated by John @since Nov12

        Route::get('/teacher/{id}','HomeController@showTeacher')->name('showteacher');
        // @created by John @since Nov14, @updated by John @since Nov14

        Route::get('/admin/rooms','HomeController@showRooms')->name('showrooms');
        // @created by John @since Nov12, @updated by John @since Nov12

        Route::post('admin/addroom','HomeController@addRoom')->name('addroom');
        // @created by John @since Nov13, @updated by John @since Nov13

        Route::post('/editroom/{id}','HomeController@editRoom')->name('editroom');
        // @created by John @since Nov13, @updated by John @since Nov13

        Route::get('admin/deleteroom/{id}','HomeController@deleteRoom')->name('deleteroom');
        // @created by John @since Nov13, @updated by John @since Nov13

        Route::get('/generateschedule','GreedyAlgorithmController@generateSchedule')->name('generateSchedule');
        // @created by John @since Dec3, @updated by John @since Dec3
        });

    Route::post('/course/assignteacher','HomeController@assignTeacher')->name('assignteacher');
    // @created by John @since Nov13, @updated by John @since Nov13

    Route::post('/teacher/assigncourse','HomeController@assignCourse')->name('assigncourse');
    // @created by John @since Nov13, @updated by John @since Nov13
    });















// XX My Controller
/* DASHBOARD CONTROLLER */
Route::get('/admin/dashboard','HomeController@getDashboard')->name('getDashboard');
// @created by Kenneth @since December 8, @updated by Kenneth @since December 8

Route::post('academic-year','HomeController@postDataAY')->name('postDataAY');
// @created by Kenneth @since December 9, @updated by Kenneth @since December 9

Route::post('delete','HomeController@postDelete')->name('postDelete');
// @created by Kenneth @since December 10, @updated by Kenneth @since December 10

/* TEACHER CONTROLLER */
Route::get('/admin/teachers','HomeController@teacher')->name('teacher');
// @created by Kenneth @since December 4, @updated by John @since December 4

Route::post('/store/teacher','HomeController@postTeacher')->name('postTeacher');
// @created by Kenneth @since December 4, @updated by John @since December 4

/* FORM FOR NEEDED IN GENERATION OF SCHEDULES */
// Route::get('/admin/generate-schedules','HomeController@getGenerateSchedule')->name('getGenerateSchedule');
// @created by Kenneth @since January 3, @updated by John @since January 3

Route::get('/admin/generate-form-schedules','HomeController@getFormGenerateSchedule')->name('getFormGenerateSchedule');
// @created by Kenneth @since January 3, @updated by John @since January 3

Route::post('/generate', 'GreedyAlgorithmController@generateSchedule')->name('generateSchedule');
// @created by Kenneth @since January 3, @updated by John @since January 3

/**  FOR CUZTOMIZATION PAGE */
Route::get('/admin/customize-schedules', 'HomeController@getCuztomizePage')->name('getCuztomizePage');

Route::post('/getRealData', 'HomeController@getRealData')->name('getRealData');

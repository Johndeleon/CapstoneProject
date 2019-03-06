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

        // Route::post('/admin/addprogram','HomeController@addProgram')->name('addProgram');
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

        // Route::get('/generateschedule','GreedyAlgorithmController@generateSchedule')->name('generateSchedule');
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

// Get Levels
Route::get('/admin/dashboard/get-levels', 'HomeController@adminGetLevels')->name('adminGetLevels');

// Get Schedules
Route::get('/admin/dashboard/get-course-schedule', 'HomeController@adminGetSchedule')->name('adminGetSchedule');

// Get Names
Route::get('/admin/dashboard/real-name-data', 'HomeController@adminGetName')->name('adminGetName');

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

Route::post('/generate', 'BaseController@generateSchedule')->name('generateSchedule'); //xxhere
// @created by Kenneth @since January 3, @updated by John @since January 3

/**  FOR CUZTOMIZATION PAGE */
Route::get('/admin/customize-schedules', 'HomeController@getCuztomizePage')->name('getCuztomizePage');

Route::get('/admin/customize-schedules/get-unavailable-time', 'HomeController@getUnavailableTime')->name('getUnavailableTime');

Route::post('/admin/customize-schedules/save-changes', 'HomeController@saveChanges')->name('saveChanges');

Route::post('/getRealData', 'HomeController@getRealData')->name('getRealData');

/* GET GENERATED SCHEDULES */
// Route::post('/getGeneratedSchedule', 'HomeController@getInitialSchedules')->name('getInitialSchedules');
Route::get('/admin/customize-schedules/get-data', 'HomeController@getInitialSchedules')->name('getInitialSchedules'); 

Route::get('/admin/customize-schedules/get-teacher-course', 'HomeController@getTeacherCourse')->name('getTeacherCourse');

Route::get('/admin/customize-schedules/teacher-available-day', 'HomeController@teacherAvailableDay')->name('teacherAvailableDay');

Route::get('/admin/customize-schedules/get-rooms', 'HomeController@getAvailableRooms')->name('getAvailableRooms');

Route::get('/admin/customize-schedules/cancel', 'HomeController@cancelInitialSchedule')->name('cancelInitialSchedule');

/* GETTING TEACHER MAX AVAILABLE DAYS */
Route::get('/getTeacherAvaiDays/{id}', 'HomeController@getMaxDays')->name('getMaxDays'); 

// EDITING THE AVAILABLE DAYS. NEEDS TEACHER AVAI_DAYS
Route::post('/getAvailableDays', 'HomeController@customGetAvaiDays')->name('customGetAvaiDays');
// SAVE AVAIDAYS CHANGES
Route::post('/saveChanges', 'HomeController@saveAvaiDayChanges')->name('saveAvaiDayChanges');

// GET ALL THE UNAVAILABLE TIME IN THIS ROOM
Route::post('/getTimeNotAvailable', 'HomeController@getTimeNotAvailable')->name('getTimeNotAvailable');
Route::get('/search/roomUnavailableTime', 'HomeController@searchUnavaiRoom')->name('searchUnavaiRoom');

// SAVED THE CUSTOMIZED CARD
Route::post('/customized-card/save', 'HomeController@customizationSave')->name('customizationSave');


/* COURSE MODULE */
Route::post('/add/new-course', 'HomeController@addNewCourse')->name('addNewCourse'); 

// Reload course table
Route::get('/admin/courses-table', 'HomeController@courseTable')->name('courseTable');
// Delete data
Route::get('/admin/courses/delete', 'HomeController@overallDelete')->name('overallDelete');
// Show Data
Route::get('/admin/courses/show', 'HomeController@overallShow')->name('overallShow');
// Update Data
Route::post('/admin/courses/update', 'HomeController@overallUpdate')->name('overallUpdate');
// Get available levels
Route::get('/admin/courses/get-level', 'HomeController@courseGetLevel')->name('courseGetLevel');
//Import courses from excel
Route::post('/admin/courses/import-courses', 'HomeController@importCourse')->name('importCourses');

/* PROGRAM MODULE */

// Program Data tables
Route::get('/load/program-table', 'HomeController@getProgramTable')->name('getProgramTable'); 
// Add Data
Route::post('/admin/programs/add-data', 'HomeController@addProgram')->name('addProgram');
// Delete Data
Route::get('/admin/programs/delete', 'HomeController@overallDelete')->name('overallDelete');
// Show Data
Route::get('/admin/programs/show', 'HomeController@overallShow')->name('overallShow');
// Update Data
Route::post('/admin/programs/update', 'HomeController@overallUpdate')->name('overallUpdate');
//Import programs from excel
Route::post('/admin/programs/import-programs', 'HomeController@importProgram')->name('importProgram');

/* TEACHER'S MODULE */

// Teacher Data Tables
Route::get('/load/teacher-table', 'HomeController@getTeacherTable')->name('getTeacherTable');
// Add new Teacher 
Route::post('/add/teacher-data', 'HomeController@postAddNewTeacher')->name('postAddNewTeacher');
// Delete Teacher
Route::get('/admin/teachers/delete', 'HomeController@overallDelete')->name('overallDelete');
// Edit teachers data
Route::get('/admin/teachers/edit', 'HomeController@overallEdit')->name('overallEdit');
// Update teachers data
Route::post('/admin/teachers/update', 'HomeController@overallUpdate')->name('overallUpdate');
//Import teachers from excel
Route::post('/admin/teachers/import-teachers', 'HomeController@importTeacher')->name('importTeachers');
//Import teachers from excel
Route::post('/admin/teachers/import-available-time', 'HomeController@importAvailableTime')->name('importAvailableTime');


/* ROOMS MODULE */

// Rooms Data table
//Import teachers from excel
Route::post('/admin/rooms/import-rooms', 'HomeController@importRoom')->name('importRooms');
Route::get('/load/rooms-table', 'HomeController@getRoomTable')->name('getRoomTable');
// Add Rooms in db
Route::post('/admin/rooms/add-rooms', 'HomeController@overallAdd')->name('overallAdd');
// Delete Rooms in DB
Route::get('/admin/rooms/delete', 'HomeController@overallDelete')->name('overallDelete');
// Update Rooms in DB
Route::get('/admin/rooms/update', 'HomeController@overallShow')->name('overallShow');
Route::post('/admin/rooms/update-room', 'HomeController@overallUpdate')->name('overallUpdate');


/* FORM GENERATE SCHEDULES MODULE */
// Generate Form
Route::post('/admin/generate-form-schedules/generate-form', 'HomeController@generateFormSchedules')->name('generateFormSchedules');
// Get Levels
Route::get('/admin/generate-form-schedules/get-data', 'HomeController@getLevels')->name('getLevels');


/* DASHBOARD MODULE */
Route::get('/admin/dashboard/multiple-delete', 'HomeController@multipleDeleteIds')->name('multipleDeleteIds');

Route::get('/admin/dashboard/delete-course', 'HomeController@deleteCourse')->name('deleteCourse');

Route::post('/admin/dashboard/store-data', 'HomeController@storeAcademicYear')->name('storeAcademicYear');

// Get active Ay
Route::post('/admin/dashboard/get-active-ay', 'HomeController@getActiveAy')->name('getActiveAy'); 

// Store the fixed schedules
Route::get('/admin/customize-schedules/fixed-schedule', 'HomeController@storeFixedSchedule')->name('storeFixedSchedule');

// Get Course Levels with Existing sched and non-existing sched
Route::get('/admin/dashboard/get-course-level', 'HomeController@getCourseLevel')->name('getCourseLevel');

// Get the Schedule
Route::get('/admin/dashboard/get-program-schedule', 'HomeController@getProgramSchedule')->name('getProgramSchedule');

// Get the program title and academic year with semester
Route::get('/admin/dashboard/get-title', 'HomeController@getTitle')->name('getTitle');


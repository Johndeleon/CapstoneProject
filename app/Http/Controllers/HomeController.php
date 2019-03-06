<?php

namespace App\Http\Controllers;
use App\Program;
use App\Course;
use App\TeacherCourse;
use App\Teacher;
use App\Room;
use App\Semester;
use App\Schedule;
use App\FixedSchedule;
use App\RoomType;
use App\CourseCategory;
use Carbon\Carbon;
use App\AcademicYear;
use App\AvailableTime;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Validator;

use App\Imports\ProgramsImport;
use App\Imports\TeachersImport;
use App\Imports\TeachersAvailabilityImport;
use App\Imports\RoomsImport;
use App\Imports\CoursesImport;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

//@created by John, @since November 7
public function showPrograms()
{

    $userId = Auth::id();
    $access_level = User::select('access_level')
                    ->where('id', $userId)
                    ->pluck('access_level');

    $accessLevel = $access_level[0];

    $programs = Program::all()
    ->where('deleted_at',null)
    ->sortByDesc('created_at');

    $acadYears = AcademicYear::select('*')
                  ->where('deleted_at', null)
                  ->orderBy('academic_year', 'asc')
                  ->get();

    return view('admin.programs',compact('programs','accessLevel', 'acadYears'));
}
//@created by John, @since November 7
public function showProgram($title, $i)
{
    $program=Program::select('title','description')
    ->where('program_category_id',5)
    ->where('title',$title)
    ->where('deleted_at',null)
    ->first();

    $teachers=Teacher::where('deleted_at',null)
    ->get();

    $courses = Course::where('deleted_at',null)
    ->get();

    $level = $i;
    return view('program',compact('program','level','teachers','courses'));
}
//@created by John, @since November 7

public function deleteProgram($id)
{
    $programDeletion = Program::where('id',$id)
    ->first();

    $programDeletion->deleted_at = Carbon::now();
    $programDeletion->save();

    return redirect('admin/programs');
}
//@created by John, @since November 7
public function editProgram(Request $request, $id)
{
    $program = Program::where('id',$id)
    ->first();

    $program->title=$request->title;
    $program->description=$request->description;
    $program->levels=$request->levels;
    $program->save();

    return redirect('admin/programs');
}
//@created by John, @since November 8

public function showCourses()
{
  $user = Auth::id();
      $access_level = User::select('access_level')
      ->where('id',$user)
      ->first();

      if($access_level->access_level == 1)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebar';
      }
      elseif($access_level->access_level == 2)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebarProgHead';
      }
      elseif($access_level->access_level == 3)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebarTeacher';
      }

    $courses=Course::where('deleted_at',null)
                        ->orderBy('id', 'DESC')
                        ->get();

    $programs = Program::select('*')
                      ->get();

    $ay = AcademicYear::select('*')
                        ->get();

    $teachers = Teacher::select('*')
                        ->get();

    return view('admin.courses',compact('courses'))
                          ->with('accessLevel', $accessLevel)
                          ->with('programs', $programs)
                          ->with('ay', $ay)
                          ->with('teachers', $teachers);
}//@created by John @since November 9

public function editCourse(Request $request, $id)
{
    $course = Course::where('id',$id)
    ->first();

    $course->code = $request->code;
    $course->title = $request->title;
    $course->units = $request->units;
    $course->description = $request->description;
    $course->save();

    return redirect('admin/courses');
}
//@created by John, @since November 10

// public function deleteCourse($id)
// {
//     $courseDeletion = Course::where('id',$id)
//                             ->first();
//     $courseDeletion->deleted_at = Carbon::now();
//     $courseDeletion->save();

//     return redirect('admin/courses');
// }
//@created by John, @since November 10

public function addCourse(Request $request)
{

for($i=0;$i< count($request->get('code'));$i++){
   $item = new Course();
   $item->code = $request->code[$i];
   $item->title = $request->title[$i];
   $item->description = $request->description[$i];
   $item->units = $request->units[$i];
   $item->save();
}

     return redirect('admin/courses');

}
//@created by John, @since November 11,@edited by John since Dec 26

public function showCourse($code)
{
$course = Course::where('code',$code)
->first();

$courseTeachers = TeacherCourse::where('teacher_courses.course_id',$course->id)
->where('teacher_courses.deleted_at',null)
->join('teachers','teacher_courses.teacher_id','=','teachers.id')
->get();

$teachers = Teacher::where('deleted_at',null)
->get();

$semesters = Semester::where('deleted_at',null)
->join('academic_years','semesters.academic_year_id','=','academic_years.id')
->get();

return view('course',compact('course','teachers','courseTeachers','semesters'));
}//@created by John, @since November 13

public function assignTeacher(Request $request)
{

$teacherInput = $request->teacher;

$teachers = Teacher::where('deleted_at',null)
->get();

$teacherid = 0;

foreach($teachers as $sample)
{
    $fullName = $sample->first_name.' '.$sample->last_name;

    if($fullName == $teacherInput)
    {
        $teacherId = $sample->id;
    }

}

$semesterInput = $request->semester;

$semesters = Semester::select('semesters.id','semesters.semester','academic_years.starts_at','academic_years.ends_at')
->where('deleted_at',null)
->join('academic_years','semesters.academic_year_id','=','academic_years.id')
->get();

$semesterId = 0;

foreach($semesters as $sample)
{
    $semester = $sample->semester.' of '.$sample->starts_at.' to '.$sample->ends_at;

    if($semester == $semesterInput)
    {
        $semesterId = $sample->id;
    }

}


$course = Course::where('id',$request->course_id)
->first();

$assigned = new TeacherCourse();
$assigned->teacher_id = $teacherId;
$assigned->course_id = $course->id;
$assigned->semester_id = $semesterId;
$assigned->save();



return redirect('course/'.$course->code);
}//@created by John, @since November 13

public function showTeachers()
{

  $user = Auth::id();
      $access_level = User::select('access_level')
      ->where('id',$user)
      ->first();

      if($access_level->access_level == 1)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebar';
      }
      elseif($access_level->access_level == 2)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebarProgHead';
      }
      elseif($access_level->access_level == 3)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebarTeacher';
      }

$teachers = Teacher::where('deleted_at',null)
->get();

return view('admin.teachers',compact('teachers'));

}//@created by John, @since November 11


public function addTeacher(Request $request)
{
$teacher = new Teacher();
$teacher->first_name=$request->first_name;
$teacher->last_name=$request->last_name;
$teacher->address=$request->address;
$teacher->contact_number=$request->contact_number;
$teacher->email=$request->email;
$teacher->save();

return redirect('teachers');

}//@created by John, @since November 12

public function editTeacher(Request $request,$id)
{
$teacher = Teacher::where('id',$id)
->first();

$teacher->first_name=$request->first_name;
$teacher->last_name=$request->last_name;
$teacher->address=$request->address;
$teacher->contact_number=$request->contact_number;
$teacher->email=$request->email;
$teacher->save();

return redirect('teachers');

}//@created by John, @since November 12

public function deleteTeacher($id)
{
$teacherDeletion = Teacher::where('id',$id)
->first();

$teacherDeletion->deleted_at = Carbon::now();
$teacherDeletion->save();

$hasCourse = TeacherCourse::where('teacher_id',$id)
->count();
if($hasCourse <1)
{
    return redirect('teachers');
}
else
{

    $teacherCourse = TeacherCourse::where('teacher_id',$id)
    ->first();

    $teacherCourse->deleted_at = Carbon::now();
    $teacherCourse->save();

return redirect('teachers');
}




}
//@created by John, @since November 10

public function showTeacher($id)
{
   $user = Auth::id();
      $access_level = User::select('access_level')
      ->where('id',$user)
      ->first();

      if($access_level->access_level == 1)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebar';
      }
      elseif($access_level->access_level == 2)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebarProgHead';
      }
      elseif($access_level->access_level == 3)
      {
          $accessLevel = $access_level->access_level;
          $sidebar = 'sidebarTeacher';
      }

$teacher = Teacher::where('id',$id)
->first();

$courses = Course::where('deleted_at',null)
->get();

$teacherCourses = TeacherCourse::where('teacher_courses.teacher_id',$id)
->where('teacher_courses.deleted_at',null)
->join('courses','teacher_courses.course_id','=','courses.id')
->get();


$availableTimes = AvailableTime::where('teacher_id',$id)
->where('deleted_at',null)
->get();
return view('admin.teacher',compact('teacher','courses','teacherCourses','semesters','availableTimes'));

}//@created by John, @since November 14, updated by John at November 24

public function assignCourse(Request $request)
{
$teacherCourse = new TeacherCourse();

$course = $request->course;

$courseId = Course::select('id')
->where('title',$course)
->where('deleted_at',null)
->first();

$semesterInput = $request->semester;

$semesters = Semester::select('semesters.id','semesters.semester','academic_years.starts_at','academic_years.ends_at')
->where('deleted_at',null)
->join('academic_years','semesters.academic_year_id','=','academic_years.id')
->get();

$semesterId = 0;

foreach($semesters as $sample)
{
    $semester = $sample->semester.' of '.$sample->starts_at.' to '.$sample->ends_at;

    if($semester == $semesterInput)
    {
        $semesterId = $sample->id;
    }

}


$teacherCourse->teacher_id = $request->teacher_id;
$teacherCourse->course_id = $courseId->id;
$teacherCourse->semester_id = $semesterId;
$teacherCourse->save();

return redirect('/teacher/'.$request->teacher_id);

}//@created by John, @since November 14


public function showRooms() {
  $userId = Auth::id();
  $access_level = User::select('access_level')
                  ->where('id', $userId)
                  ->pluck('access_level');

  $accessLevel = $access_level[0];

  $rooms = Room::select('rooms.id','rooms.room_name','rooms.room_type_id','rooms.available_time_start'
  ,'rooms.available_time_finish','room_types.room_type')
  ->where('rooms.deleted_at',null)
  ->join('room_types','rooms.room_type_id','=','room_types.id')
  ->get();

  $roomTypes= RoomType::where('deleted_at',null)
  ->get();

  $times = ['06:00 am',
            '06:30 am',
            '07:00 am',
            '07:30 am',
            '08:00 am',
            '08:30 am',
            '09:00 am',
            '09:30 am',
            '10:00 am',
            '10:30 am',
            '11:00 am',
            '11:30 am',
            '12:00 nn',
            '12:30 pm',
            '01:00 pm',
            '01:30 pm',
            '02:00 pm',
            '02:30 pm',
            '03:00 pm',
            '03:30 pm',
            '04:00 pm',
            '04:30 pm',
            '05:00 pm',
            '05:30 pm',
            '06:00 pm',
            '06:30 pm',
            '07:00 pm',
            '07:30 pm',
            '08:00 pm',
  ];

  $count=count($times);

  return view('admin.rooms',compact('rooms','roomTypes','times','count', 'accessLevel'));

}//@created by John, @since November 11

public function addRoom(Request $request)
{
$room = new Room();
$roomTypeId = RoomType::where('room_type',$request->room_type)
->first();

$room->room_name = $request->room_name;
$room->room_type_id = $roomTypeId->id;
$room->available_time_start = $request->available_from;
$room->available_time_finish = $request->available_until;
$room->save();

return redirect('admin/rooms');
}//@created by John, @since November 13

public function editRoom(Request $request, $id)
{
$room = Room::where('id',$id)
->first();

$roomTypeId = RoomType::where('room_type',$request->room_type)
->first();


$room->room_name = $request->room_name;
$room->room_type_id = $roomTypeId->id;
$room->available_time_start = $request->available_from;
$room->available_time_finish = $request->available_until;
$room->save();

return redirect('admin/rooms');
}//@created by John, @since November 13

public function deleteRoom($id)
{
$roomDeletion = Room::where('id',$id)
->first();

$roomDeletion->deleted_at = Carbon::now();
$roomDeletion->save();

return redirect('admin/rooms');
}
//@created by John, @since November 13



  // xx Kenneth's Controller
  public function teacher() {
    $userId = Auth::id();
    $access_level = User::select('access_level')
                    ->where('id', $userId)
                    ->pluck('access_level');

    $accessLevel = $access_level[0];

    $teachers = Teacher::all();

    return view('admin.teacher')
                ->with('accessLevel', $accessLevel)
                ->with('teachers', $teachers);
  }

  public function postTeacher(Request $request) {
      $teachers = new Teacher;
      $teachers->first_name = $request->firstname;
      $teachers->last_name = $request->lastname;
      $teachers->address = $request->address;
      $teachers->contact_number = $request->contactnumber;
      $teachers->email = $request->email;
      $teachers->save();

      // SAVING AVAILABLE DAYS
      $avaDays = new AvailableTime;
      $avaDays->teacher_id = $teachers->id;
      $avaDays->available_day = $request->available_days;
      $avaDays->time_start = "700";
      $avaDays->time_finish = "2000";
      $avaDays->save();

      return redirect()->back()
              ->with('added', 'Successfully added!');
  }

  public function getDashboard() {
      $academicYears = AcademicYear::select('*')
                                  ->orderBy('academic_year', 'asc')
                                  ->where('deleted_at', null)
                                  ->get();

      if (count($academicYears) == 1) {
        $c_status = AcademicYear::select('*')
                                  ->first();

        $c_status->status = 1;
        $c_status->save();
      }

      if (count($academicYears) > 0) {
          $active_ay = AcademicYear::where('status', 1)
                                    ->first()->id;

          $ay = AcademicYear::where('status', 1)->first()->academic_year;

          $programs = Program::where('academic_year_id', $active_ay)
                              ->where('deleted_at', null)
                              ->get();

          // $user = Auth::id();
          // $access_level = User::select('access_level')
          // ->where('id',$user)
          // ->first();

          // if($access_level->access_level == 1)
          // {
          //     $accessLevel = $access_level->access_level;
          //     $sidebar = 'sidebar';
          // }
          // elseif($access_level->access_level == 2)
          // {
          //     $accessLevel = $access_level->access_level;
          //     $sidebar = 'sidebarProgHead';
          // }
          // elseif($access_level->access_level == 3)
          // {
          //     $accessLevel = $access_level->access_level;
          //     $sidebar = 'sidebarTeacher';
          // }

      } else {
        $programs = Program::where('deleted_at', null)
                           ->get();

        $ay = AcademicYear::all();

        return view('admin.adminDashboard')->with('academicYears', $academicYears)
                                          ->with('programs', $programs)
                                          ->with('ay', $ay);

      }
      
      
      return view('admin.adminDashboard')->with('academicYears', $academicYears)
                                        ->with('programs', $programs)
                                        // ->with('accessLevel', $accessLevel)
                                        // ->with('sidebar', $sidebar)
                                        ->with('ay', $ay);
  }

  /* DASHBOARD MODULE */
  public function multipleDeleteIds(Request $req) {
    $ids = $req->ids;

    foreach ($ids as $item) {
      $p = Program::where('id', $item)->first();
      $p->deleted_at = Carbon::now();

      if ($p->save()) {
        $status = true;
        $message = 'The courses are successfully deleted.';

      } else {
        $status = false;
        $message = 'Internal Server Error, please contact the deleveloper.';

        break;
      }
    }

    $data = array(
      'status' => $status,
      'message' => $message,
    );

    return json_encode($data);
  }

  public function deleteCourse(Request $req) {
    $p = Program::where('id', $req->id)
                ->first();
    $p->deleted_at = Carbon::now();

    if ($p->save()) {
      $status = true;
      $message = $p->title . ' is successfully deleted.';
      
    } else {
      $status = false;
      $message = 'Internal Server Error, please contact the developers.';

    }

    $data = array(
      'status' => $status,
      'message' => $message
    );

    return json_encode($data);
  }

  public function getTitle(Request $req) {
    $ay = AcademicYear::where('id', $req->ay)
                      ->first()->academic_year;

    $p = Program::where('id', $req->program)
                ->first()->title;

    $data = array(
      'status' => true,
      'academic_year' => $ay,
      'program_name' => $p,
    );

    return json_encode($data);
  }

  public function getProgramSchedule(Request $req) {
    $s = FixedSchedule::where('academic_year_id', $req->ay)
                 ->where('semester', $req->sem)
                 ->where('program_id', $req->id)
                 ->where('level', $req->level)
                 ->get();

    $data = array(
      'status' => true,
      'schedule' => $s,
    );

    return json_encode($data);
  }

  public function getCourseLevel(Request $req) {
    $level = Program::where('id', $req->id)
                      ->first()->levels;

    $prog_w_schedule = Schedule::where('academic_year_id', $req->ay)
                              ->where('semester', $req->sem)
                              ->where('program_id', $req->id)
                              ->get();

    $withSchedule = array();

    foreach ($prog_w_schedule as $item) {
      
      if (empty($withSchedule)) {
        array_push($withSchedule, $item->level);

      } else if (in_array($item->level, $withSchedule)) {
        # code...
      } else {
        array_push($withSchedule, $item->level);

      }
    }

    $status = true;

    $data = array(
      'status' => $status,
      'levelWithSched' => $withSchedule,
      'level' => $level,
    );

    return json_encode($data);
  }

  public function getActiveAy(Request $req) {
    $active = AcademicYear::where('status', 1)
                            ->first();

    // Setting the active
    if (count($active) > 0) {
      $active->status = 0;
      $active->save();

      $new_active = AcademicYear::where('id', $req->academic_year)
                                ->first();
      $new_active->status = 1;
      $new_active->save();

    } else {
      $new_active = AcademicYear::where('id', $req->academic_year)
                                ->first();
      $new_active->status = 1;
      $new_active->save();

    }

    $id = $new_active->id;
    $ay = AcademicYear::where('id', $id)->first();

    $data = array(
      'status' => true,
      'academic_year' => $id,
      'ay' => $ay,
      'semester' => $req->semester,
    );

    return json_encode($data);

  }

  public function storeAcademicYear(Request $req) {
    $validator = Validator::make($req->all(), [
      'year_start' => 'required|numeric|min:4|unique:academic_years,starts_at'
    ]);

    if ($validator->fails()) {
      $status = false;

      $data = array(
        'status' => $status,
        'errors' => $validator->errors()->all(),
      );

      return json_encode($data);
    }

    $academic_year = $req->year_start . ' - ' . $req->year_end;

    $ay = new AcademicYear;
    $ay->academic_year = $academic_year;
    $ay->starts_at = $req->year_start;
    $ay->ends_at = $req->year_end;
    $ay->status = 0;

    if ($ay->save()) {
      $id = $ay->id;
      $status = true;
      $message = $academic_year . " is successfully stored in your system";
      
    } else {
      $status = false;
      $message = "Internal Server Error, please contact the developers.";

    }

    // Check if this is the first academic year existed
    $ay = AcademicYear::select('*')
                        ->get();

    if (count($ay) == 1) {
      $ay = AcademicYear::select('*')
                          ->first();

      $ay->status = 1;
      $ay->save();
    }

    $data = array(
      'status' => $status,
      'message' => $message,
      'academic_title' => $academic_year,
      'id' => $id,
    );

    return json_encode($data);
  }

  // xxgetlev
  public function adminGetLevels(Request $req) { 
    $s = Schedule::select('*')
                  ->where('academic_year_id', $req->ay_id)
                  ->where('semester', $req->sem)
                  ->where('deleted_at', null)
                  ->get();

    $getLevel = array();
    foreach ($s as $item) {
      $prog_id = $item->program_id;
      $level = $item->level;
      $id = $prog_id .'-'.$level;

      if (empty($getLevel)) {
        array_push($getLevel, $id);
        
      } else if (in_array($id, $getLevel)) {
        
      } else {
        array_push($getLevel, $id);

      }
      
    }

    $data = array(
      'status' => true,
      'schedule' => $getLevel,
    );

    return json_encode($data);

    // $levels = array();

    // foreach ($s as $item) {
    //   if (empty($levels)) {
    //     array_push($levels, $item->program_id);

    //   } else if (in_array($item->program_id, $levels)) {
        
    //   } else {
    //     array_push($levels, $item->program_id);

    //   }
    // }

    // foreach ($levels as $level) {
    //   $s = Schedule::where('program_id', $level)
    //                 ->first();

    //   array_push($getLevel, $s);
    // }

    // $data = array(
    //   'data' => $getLevel,
    //   'status' => true, 
    // );

    return json_encode($data);
  }

  public function adminGetName(Request $req) {
    $t = Teacher::where('id', $req->teacher_id)->first();
    $f_name = $t->first_name . ' ' . $t->last_name;

    $r = Room::where('id', $req->room_id)->first()->room_name;

    $c = Course::where('id', $req->course_id)->first()->title;

    $data = array(
      'teacher' => $f_name,
      'room' => $r,
      'course' => $c,
    );

    return json_encode($data);
  }

  public function adminGetSchedule(Request $req) {
    $s = Schedule::where('program_id', $req->id)
                  ->where('level', $req->level)
                  ->first();

    $sched = Schedule::where('academic_year_id', $s->academic_year_id)
                      ->where('semester', $s->semester)
                      ->where('program_id', $s->program_id)
                      ->where('level', $s->level)
                      ->get();

    $data = array(
      'status' => true,
      'schedule' => $sched,
    );

    return json_encode($data);
  }

  public function getCommentsAttribute()
    {
        $comments = $this->comments()->getQuery()->orderBy('created_at', 'desc')->get();
        return $comments;
    }

  public function postDataAY(Request $request) {
     $acadYr = new AcademicYear;
     $acadYr->academic_year = $request->academicYear;
     $acadYr->starts_at = 2018;
     $acadYr->ends_at = 2019;
     $acadYr->save();

     return $acadYr;
  }

  public function postDelete(Request $request) {
    $id = $request->id;
    AcademicYear::where('id', $id)->delete();

    return $request->all();
  }

  /* FORM GENERATION OF SCHEDULES */
  public function getGenerateSchedule() {
      $userId = Auth::id();
      $access_level = User::select('access_level')
                      ->where('id', $userId)
                      ->pluck('access_level');

      $accessLevel = $access_level[0];

      $programs = Program::where('deleted_at',null)->get()->sortByDesc('created_at');

      return view('admin.generateSchedule')
                  ->with('accessLevel', $accessLevel)
                  ->with('programs', $programs);
  }

  public function getFormGenerateSchedule() {
      $userId = Auth::id();
      $access_level = User::select('access_level')
                      ->where('id', $userId)
                      ->pluck('access_level');

      $accessLevel = $access_level[0];

      $academicYears = AcademicYear::select('*')
                                ->where('deleted_at',null)
                                ->orderBy('academic_year', 'asc')
                                ->get();

      $courses = Course::where('deleted_at',null)
      ->get();

      $teachers = Teacher::where('deleted_at',null)
      ->get();

      $roomTypes = RoomType::where('deleted_at',null)
      ->get();

      $programs = Program::where('deleted_at',null)
      ->get();

      return view('admin.form-generate-schedule')
                  ->with('accessLevel', $accessLevel)
                  ->with('academicYears', $academicYears)
                  ->with('courses', $courses)
                  ->with('teachers', $teachers)
                  ->with('roomTypes',$roomTypes)
                  ->with('programs', $programs);
  }

  public function postForm(Request $request) {
      $program_title = $request->program_title;
      $program_id = Program::select('id')
                            ->where('title', $program_title)
                            ->where('deleted_at', null)
                            ->pluck('id');

      $program_id = $program_id[0];
      $level = $request->level;
      $roomtype= $request->roomtype;
      $academic_year = $request->academic_year;
      $semester = $request->semester;
      $courses = $request->courses;
      $teachers = $request->teachers;
      $total_hours = $request->total_hours;
      $meeting = $request->meeting;

      return $request->all();
  }

  /** CUSTOMIZATION PAGE */
  public function getCuztomizePage() {
    $userId = Auth::id();
    $access_level = User::select('access_level')
                      ->where('id', $userId)
                      ->pluck('access_level');

    $accessLevel = $access_level[0];


    return view('generatedSchedules.customizeable-schedule')
                ->with('accessLevel', $accessLevel);
  }

  public function getInitialSchedules(Request $req) {
    $s = Schedule::where('academic_year_id', $req->academic_year)
                  ->where('semester', $req->semester)
                  ->where('program_id', $req->id)
                  ->get();

    return json_encode($s);
  }

  public function getTeacherCourse(Request $req) {
    $t = Teacher::where('id', $req->t_id)->first();
    $fullname = $t->first_name . ' ' . $t->last_name;

    $c = Course::where('id', $req->c_id)->first()->title;

    $r = Room::where('id', $req->r_id)->first()->room_name;

    $data = array(
      'teacher' => $fullname,
      'title' => $c,
      'room' => $r,
    );

    return json_encode($data);
  }

  public function getRealData(Request $req) {
      $teacher_id = $req->teacher;
      $room_id = $req->room;
      $ay = $req->ay;
      $program_id = $req->program;
      $semester = $req->semester;
      $course_id = $req->course;

      $teacher = Teacher::select('first_name', 'last_name')
                          ->where('id', $teacher_id)
                          ->first();

      $teacher = $teacher->first_name .' '.$teacher->last_name;

      $course = Course::select('title')
                        ->where('id', $course_id)
                        ->first();

      $course = $course->title;

      $room = Room::select('room_name')
                        ->where('id', $room_id)
                        ->first();

      $room = $room->room_name;

      $data['names'] = array(
        'id' => $req->id,
        'teacher_id' => $req->teacher,
        'teacher' => $teacher,
        'course' => $course,
        'room' => $room,
        'program' => $req->program,
        'semester' => $req->semester,
      );

      return $data;





    // $academicId = $req->academicID;
    // $programId = $req->programID;
    // $semester = $req->semester;
    //
    // $query = Schedule::where('academic_year_id', $academicId)
    //                 ->where('semester', $semester)
    //                 ->where('program_id', $programId)
    //                 ->get();
    //
    // $subjects = [];
    //
    //
    // foreach ($query as $item) {
    //     /**GETTING TEACHERS NAME */
    //     $teacher = Teacher::where('id', $item['teacher_id'])->first();
    //     $teacher = $teacher->first_name .' '. $teacher->last_name;
    //     // array_push($subjects, ["teacher"=>$teacher]);
    //
    //     $subject = Course::where('id', $item['course_id'])->first();
    //     $subject = $subject->title;
    //
    //     $time = $item['time_start'] .' - '. $item['time_finish'];
    //
    //     $room = Room::where('id', $item['room_id'])->first();
    //     $room = $room->room_name;
    //
    //     $day = $item['day_of_week'];
    //
    //
    //     array_push($subjects, ["subject" => $subject, "teacher" => $teacher, "time" => $time, "room" => $room, "day" => $day]);
    //
    // }
    //
    // return $subjects;
    // return $query;
    // return $query;
  }

  /* GET TEACHER MAX DAYS */
  public function getMaxDays($id) {
    $teacher_max_days = AvailableTime::select('*')
                            ->where('teacher_id', $id)
                            ->count();

    return $teacher_max_days;
  } 

  /* GET AVAIDAYS */
  public function customGetAvaiDays(Request $req) {

    $course_id = (int)$req->course_id;
    $program_id = (int)$req->program_id;
    $semester = (int)$req->semester;
    $teacher = (int)$req->teacher;
    $ay_id = (int)$req->ay;

    $query = Schedule::select('*')
                    ->where('academic_year_id', $ay_id)
                    ->where('semester', $semester)    
                    ->where('program_id', $program_id)
                    ->where('course_id', $course_id)
                    ->where('teacher_id', $teacher)
                    ->get();

    $teacher_max_days = AvailableTime::select('*')
                          ->where('teacher_id', $req->teacher)
                          ->get();

    $data = array(
      'selected_day' => $query,
      'available_day' => $teacher_max_days
    );

    return $data;


  }

  /* SAVE AVAIDAYS CHANGES */
  public function saveAvaiDayChanges(Request $req) {
    $currDay = (int)$req->current_day;
    $day = (int)$req->day;
    $id = (int)$req->id;

    // $data = array(
    //   $currDay,
    //   $day,
    //   $id
    // );

    $query = Schedule::where('id', $id)
                      ->first();

    $query->day_of_week = $day;
    $query->save();  
  } 

  /* GET ALL THE UNAVAILABLE TIME IN THIS ROOM */
  public function getTimeNotAvailable(Request $req) {

    $currDay = (int)$req->current_day;
    $room = (int)$req->room;
    $semester = (int)$req->semester;
    $ay_id = (int)$req->ay;
    $currTime = $req->currTime;
    $currTime = explode("-", $currTime);

    $query = Schedule::where('academic_year_id', $ay_id)
                      ->where('semester', $semester)
                      ->where('room_id', $room)
                      ->where('day_of_week', $currDay)
                      ->where('time_start', '!=', $currTime[0], 'AND', 'time_finish', '!=', $currTime[1])
                      ->get();

    $roomQuery = Room::select('*')
                      ->where('id', '!=', $room)
                      ->get();


    $data = array(
      'unavailableTime' => $query,
      'rooms' => $roomQuery,
    );

    return $data;

  } 

  public function searchUnavaiRoom(Request $req) {
    $currTime = $req->currTime;
    $currTime = explode("-", $currTime);

    $query = Schedule::select('*')
                      ->where('academic_year_id', $req->ay)
                      ->where('semester', $req->sem)
                      ->where('room_id', $req->room)
                      ->where('day_of_week', $req->day)
                      ->get();

    return $query;
  }

  public function customizationSave(Request $req) {
    $id = $req->id;
    $start_time = $req->start_time;
    $end_time = $req->end_time;
    $room_id = $req->room;

    $save = Schedule::where('id', $id)
                      ->first();
    $save->time_start = $start_time;
    $save->time_finish = $end_time;
    $save->room_id = $room_id;
    $save->save();
  }

  /* Course Module */ 
  public function courseGetLevel(Request $req) {
    $p_level = Program::where('id', $req->id)
                  ->first()->levels;

    $data = array(
      'status' => true,
      'level' => $p_level,
    );

    return json_encode($data);
  }

  public function addNewCourse(Request $req) {
    
    $validator = Validator::make($req->all(), [
      'ay' => 'required',
      'sem' => 'required',
      'course' => 'required',
      'level' => 'required',
      'code' => 'required|unique:courses,code',
      'title' => 'required|unique:courses,title',
      'teacher' => 'required',
    ]);

    if ($validator->fails()) {
      $status = false;

      $data = array(
        'status' => $status,
        'errors' => $validator->errors()->all(),
      );

      return json_encode($data);
    }
    
    $c_teacher = $req->teacher;
    $prog_id = Program::where('id', $req->course)
                        ->first();

    for ($i=0; $i < count($c_teacher); $i++) { 
      $c = new Course;
      $c->program_id = $prog_id->id;
      $c->academic_year = $req->ay;
      $c->semester = $req->sem;
      $c->level = $req->level;
      $c->teacher = $req->teacher[$i];
      $c->title = $req->title;
      $c->code = $req->code;
      $c->units = 4;
      $c->save();
    }

    $data = array(
      'message' => 'Successfully added to your course table!',
      'status' => true,
    );

    return json_encode($data);


    // return $c_teacher;
  }

  public function messages() {
    return [
      'ay.required' => 'A academic year selection is required.'
    ];
  }

  public function courseTable() {
    $courses = $c = Course::select('*')
                           ->orderBy('id', 'DESC')
                           ->get();

    if (count($courses) == 0) {
      $data['aaData'] = array();

      return json_encode($data);
    }

    $subjectArr = array();

    $subCount = 1;

    foreach ($courses as $item) {
      if (count($subjectArr) == 0) {
        array_push($subjectArr, $item->code);
        
      } else if (in_array($item->code, $subjectArr)) {

      } else {
        array_push($subjectArr, $item->code);

      } 
    }

    foreach ($subjectArr as $item) {
      $course = Course::where('code', $item)
                    ->first();
      $courseCount = Course::where('code', $item)
                              ->count();

      $courseND['course'][] = array(
        'course' => $course,
        'total' => $courseCount,
      );
      
    }

    if (count($courseND) > 0) {

      foreach ($courseND['course'] as $item) {

        $code = $item['course']->code;
        $title = $item['course']->title;
        $total = $item['total'] . '<span class="btn-choose mr-1" hidden>
                                    <a id="course-'. $item['course']->id .'" title="Delete" class="btn btn-circle btn-danger delete">
                                      <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>

                                    <a id="course-'. $item['course']->id .'" href="#editData" data-toggle="modal" title="Edit" class="btn btn-circle btn-info ml-1 edit">
                                      <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                  </span>

                                  <a class="mr-1 btn btn-default tbl-hover-btn text-dark btn-circle for-edit-delete" title="Click for actions" style="background: #c0c0c0">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                  </a>';

        $data['aaData'][] = array(
          $code,
          $title,
          $total,
        );
      }

    } else {

      $data['aaData'] = array(); 
    }

    return json_encode($data);
  }

  public function getProgramTable() {
    $programs = Program::select('*')
                        ->orderBy('id', 'DESC')
                        ->get();

    if (count($programs) > 0) {
      
      foreach ($programs as $item) {

        $description = $item->description.'<span class="btn-choose mr-1" hidden>
                                            <a id="program-'. $item->id .'" title="Delete" class="btn btn-circle btn-danger delete">
                                              <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>

                                            <a id="program-'. $item->id .'" href="#editData" data-toggle="modal" title="Edit" class="btn btn-circle btn-info ml-1 edit">
                                              <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                          </span>

                                          <a class="mr-1 btn btn-default tbl-hover-btn text-dark btn-circle for-edit-delete" title="Click for actions" style="background: #c0c0c0">
                                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                          </a>';
        
        $data['aaData'][] = array(
          $item->title,
          $description,
        );

      }

    } else {
      $data['aaData'] = array();
    }

    return json_encode($data);
  }

  public function delete(Request $req) {
    $id = $req->id;

    $p = Program::where('id', $id);
    
    if ($p->delete()) {
      $message = 'The selected program is Successfully Deleted!';
      $status = 'Success';
    } else {
      $message = 'Internal Server Error please contact the developers';
      $status = 'Fail';
    }

    $data = array(
      'message' => $message,
      'status' => $status
    );

    return json_encode($data);
  }

  public function getTeacherTable() {
    $t = Teacher::select('*')
                  ->orderBy('id', 'DESC')
                  ->get();

    if (count($t) > 0) {
      foreach ($t as $item) {
        $fullname = $item->first_name . ' ' . $item->last_name;
        $contact = $item->contact_number;
        $email = $item->email . '<span class="btn-choose mr-1" hidden>
                                  <a id="teacher-'. $item->id .'" title="Delete" class="btn btn-circle btn-danger delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                  </a>

                                  <a id="teacher-'. $item->id .'" href="#editData" data-toggle="modal" title="Edit" class="btn btn-circle btn-info ml-1 edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                  </a>
                                </span>

                                <a class="mr-1 btn btn-default tbl-hover-btn text-dark btn-circle for-edit-delete" title="Click for actions" style="background: #c0c0c0">
                                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </a>';

        $data['aaData'][] = array(
          $fullname,
          $contact,
          $email,
        ); 
      }
    }
    else {
      $data['aaData'] = array();
    }

    return json_encode($data);
  }

  public function postAddNewTeacher(Request $req) {

    $validator = Validator::make($req->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'contact' => 'required|numeric|max:11111111111',
      'email' => 'required|email',

    ]);

    $avaiDay = array();
    
    if ($req->cb_monday == 'on') {
      if ($req->mon_time1 != null && $req->mon_time2 != null) {

        $time1 = str_replace(':', '', $req->mon_time1);
        $time2 = str_replace(':', '', $req->mon_time2);
        

        $at_data = array(
          'day' => 1,
          's_time' => $time1,
          'f_time' => $time2,
        );

        array_push($avaiDay, $at_data);

      } else {
        $message = "No value inputted. Check your monday input box.";
        $status = false;

        $data = array(
          'message' => $message,
          'status' => $status,
        );

        return json_encode($data);
      }
    }

    if ($req->cb_tuesday == 'on') {
      if ($req->tue_time1 != null && $req->tue_time2 != null) {

        $time1 = str_replace(':', '', $req->tue_time1);
        $time2 = str_replace(':', '', $req->tue_time2);
        

        $at_data = array(
          'day' => 2,
          's_time' => $time1,
          'f_time' => $time2,
        );

        array_push($avaiDay, $at_data);

      } else {
        $message = "No value inputted. Check your tuesday input box.";
        $status = false;

        $data = array(
          'message' => $message,
          'status' => $status,
        );

        return json_encode($data);
      }
    }

    if ($req->cb_wednesday == 'on') {
      if ($req->wed_time1 != null && $req->wed_time2 != null) {

        $time1 = str_replace(':', '', $req->wed_time1);
        $time2 = str_replace(':', '', $req->wed_time2);
        

        $at_data = array(
          'day' => 3,
          's_time' => $time1,
          'f_time' => $time2,
        );

        array_push($avaiDay, $at_data);

      } else {
        $message = "No value inputted. Check your wednesday input box.";
        $status = false;

        $data = array(
          'message' => $message,
          'status' => $status,
        );

        return json_encode($data);
      }
    }

    if ($req->cb_thursday == 'on') {
      if ($req->thu_time1 != null && $req->thu_time2 != null) {

        $time1 = str_replace(':', '', $req->thu_time1);
        $time2 = str_replace(':', '', $req->thu_time2);
        

        $at_data = array(
          'day' => 4,
          's_time' => $time1,
          'f_time' => $time2,
        );

        array_push($avaiDay, $at_data);

      } else {
        $message = "No value inputted. Check your thursday input box.";
        $status = false;

        $data = array(
          'message' => $message,
          'status' => $status,
        );

        return json_encode($data);
      }
    }

    if ($req->cb_friday == 'on') {
      if ($req->fri_time1 != null && $req->fri_time2 != null) {

        $time1 = str_replace(':', '', $req->fri_time1);
        $time2 = str_replace(':', '', $req->fri_time2);
        

        $at_data = array(
          'day' => 5,
          's_time' => $time1,
          'f_time' => $time2,
        );

        array_push($avaiDay, $at_data);

      } else {
        $message = "No value inputted. Check your friday input box.";
        $status = false;

        $data = array(
          'message' => $message,
          'status' => $status,
        );

        return json_encode($data);
      }
    }

    if ($req->cb_saturday == 'on') {
      if ($req->sat_time1 != null && $req->sat_time2 != null) {

        $time1 = str_replace(':', '', $req->sat_time1);
        $time2 = str_replace(':', '', $req->sat_time2);
        

        $at_data = array(
          'day' => 6,
          's_time' => $time1,
          'f_time' => $time2,
        );

        array_push($avaiDay, $at_data);

      } else {
        $message = "No value inputted. Check your saturday input box.";
        $status = false;

        $data = array(
          'message' => $message,
          'status' => $status,
        );

        return json_encode($data);
      }
    }

    // $validator = Validator::make($req->all(), [
    //   'firstName' => 'required',
    //   'lastName' => 'required',
    //   'contact' => 'required',
    //   'email' => 'required',
    // ]);

    if ($validator->fails()) {
      $status = false;

      $data = array(
        'status' => $status,
        'errors' => $validator->errors()->all(),
      );

      return json_encode($data);
    }

    if (empty($avaiDay)) {
      
      $message = "The teacher must have 1 or more available day in order to proceed.";
      $status = false;

      $data = array(
        'message' => $message,
        'status' => $status,
      );

      return json_encode($data);
    }

    $t = new Teacher;
    $t->first_name = $req->first_name;
    $t->last_name = $req->last_name;
    $t->address = $req->address;
    $t->contact_number = $req->contact;
    $t->email = $req->email;

    if ($t->save()) {

      foreach ($avaiDay as $item) {
        
          $at = new AvailableTime;
          $at->teacher_id = $t->id;
          $at->available_day = $item['day'];
          $at->time_finish = $item['f_time'];
          $at->time_start = $item['s_time'];
          $at->save();

        }

      $message = 'The teacher successfully stored in the database!';
      $status = true;
    }

    $data = array(
      'message' => $message,
      'status' => $status,
    );

    return json_encode($data);
  }

  public function overallDelete(Request $req) {
    $type = $req->type;
    $id = $req->id;

    if ($type == 'teacher') {
      $t = Teacher::where('id', $id)
                    ->first();
      $name = $t->first_name.' '.$t->last_name;

      if ($t->delete()) {
        $status = true;
        $message = $name . ' is successfully deleted.';
      }

    }

    else if ($type == 'course') {
      $c = Course::where('id', $id)
                  ->first();
      // Get all the data with the same acadyear, semester, title
      $courses = Course::where('academic_year', $c->academic_year)
                        ->where('semester', $c->semester)
                        ->where('title', $c->title)
                        ->get();

      foreach ($courses as $item) {
        
        $id = $item->id;
        $c = Course::where('id', $id)
                      ->first();

        if ($c->delete()) {
          $status = true;
          $message = "This row is successfully deleted.";
        }
        else {
          $status = false;
          $message = "Internal Server Error, please contact the developers.";
        }
      }

    } /* End of courses */

    else if ($type == 'room') {
      $r = Room::where('id', $id)
                ->first();

      $r_name = $r->room_name;

      if ($r->delete()) {
        $status = true;
        $message = $r_name . " is successfully deleted.";
      }
    }

    else if ($type == 'program') {
      $p = Program::where('id', $id)
                    ->first();

      $title = $p->title;

      if ($p->delete()) {
        $status = true;
        $message = $title . " is successfully deleted.";
      }
    }

    $data = array(
      'message' => $message,
      'status' => $status,
    );

    return json_encode($data);
  }

  public function overallEdit(Request $req) {
    $type = $req->type;
    $id = $req->id;

    if ($type == 'teacher') {
      
      $t = Teacher::where('id', $id)
                    ->first();

      return json_encode($t);
    }

  }

  public function overallUpdate(Request $req) {

    if (!empty($req->idtype)) {
      $idtype = $req->idtype;
      $ids = explode('-', $idtype);
      
      $type = $ids[0];
      $id = $ids[1];

    } else {
      $type = $req->type;
      $id = $req->id;
    }

    if ($type == 'teacher') {
      
      $t = Teacher::where('id', $id)
                    ->first();

      $t->first_name = $req->first_name;
      $t->last_name = $req->last_name;
      $t->contact_number = $req->contact;
      $t->email = $req->email;
      $t->address = $req->address;

      if ($t->save()) {
        $id = $t->id;
        $t = Teacher::where('id', $id)
                      ->first();

        $status = true;
        $message = $t->first_name . ' '. $t->last_name ." data changes are successfully updated!";

      }
    }
    else if ($type == 'course') {

      $c = Course::where('id', $id)
                    ->first();

      $courses = Course::where('academic_year', $c->academic_year)
                      ->where('semester', $c->semester)
                      ->where('title', $c->title)
                      ->get();

      foreach ($courses as $item) {
        
        $c = Course::where('id', $item->id)
                    ->first();

        $c->title = $req->title;
        $c->code = $req->code;

        if ($c->save()) {
          
          $status = true;
          $message = "Your data is successfully updated.";

        } else {

          $status = false;
          $message = "Something went wrong, please contact the developers.";
        }
      }

    }
    else if ($type == 'room') {
      $r = Room::where('id', $id)
                  ->first();

      $r->room_name = $req->room_name;
      $r->room_type_id = $req->room_type;
      $r->available_time_start = $req->start_time;
      $r->available_time_finish = $req->finish_time;

      if ($r->save()) {
        $room_name = Room::where('id', $id)->first()->room_name;

        $status = true;
        $message = $room_name . " is successfully updated.";
      }

    }
    else if ($type == 'program') {

      $p = Program::where('id', $id)
                    ->first();

      $p->title = $req->title;
      $p->description = $req->description;

      if ($p->save()) {
        $p = Program::where('id', $id)
                      ->first();
        $title = $p->title;

        $status = true;
        $message = $title . " is successfully updated.";
      }

    }

    $data = array(
      'status' => $status,
      'message' => $message,
    );

    return json_encode($data);

  }

  public function getRoomTable() {
    $r = Room::select('*')
                ->orderBy('id', 'DESC')
                ->get();

    if (count($r) > 0) {
      foreach ($r as $item) {
        
        $name = $item->room_name;
        $start_time = $item->available_time_start;

        if (strlen($start_time) == 3) {
          $start_time_last_digit = substr($start_time, 1, 3);

          if ($start_time_last_digit === 00) {
            $start_time = substr_replace($start_time, ':', 1);
            $start_time = $start_time.'00';
          } else {
            $start_time = substr_replace($start_time, ':', 1);
            $start_time = $start_time.$start_time_last_digit;

          }

        } else if (strlen($start_time) == 4) {
          $start_time_last_digit = substr($start_time, 2, 3);

          if ($start_time_last_digit === 00) {
            $start_time = substr_replace($start_time, ':', 2);
            $start_time = $start_time.'00';
          } else {
            $start_time = substr_replace($start_time, ':', 2);
            $start_time = $start_time.$start_time_last_digit;

          }

        }

        $end_time = $item->available_time_finish;

        if (strlen($end_time) == 3) {
          $start_time_last_digit = substr($end_time, 1, 3);

          if ($start_time_last_digit === 00) {
            $end_time = substr_replace($end_time, ':', 1);
            $end_time = $end_time.'00';

          } else {
            $end_time = substr_replace($end_time, ':', 1);
            $end_time = $end_time.$start_time_last_digit;

          }

        } else if (strlen($end_time) == 4) {
          $start_time_last_digit = substr($end_time, 2, 3);

          if ($start_time_last_digit === 00) {
            $end_time = substr_replace($end_time, ':', 2);
            $end_time = $end_time.'00';

          } else {
            $end_time = substr_replace($end_time, ':', 2);
            $end_time = $end_time.$start_time_last_digit;

          }

        }

        $end_time = $end_time . '<span class="btn-choose mr-1" hidden>
                                  <a id="room-'. $item->id .'" title="Delete" class="btn btn-circle btn-danger delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                  </a>

                                  <a id="room-'. $item->id .'" href="#editData" data-toggle="modal" title="Edit" class="btn btn-circle btn-info ml-1 edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                  </a>
                                </span>

                                <a class="mr-1 btn btn-default tbl-hover-btn text-dark btn-circle for-edit-delete" title="Click for actions" style="background: #c0c0c0">
                                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </a>';

        $data['aaData'][] = array(
          $name,
          $start_time,
          $end_time,
        );

      }
    } else {

      $data['aaData'] = array();

    }

    return json_encode($data);
  }

  public function overallAdd(Request $req) {

    $validator = Validator::make($req->all(), [
      'room_name'  => 'required',
      'start_time' => 'required|numeric',
      'end_time'   => 'required|numeric',
      'room_type'  => 'required',
    ]);

    if ($validator->fails()) {
      $status = false;

      $data = array(
        'status' => $status,
        'errors' => $validator->errors()->all(),
      );

      return json_encode($data);
    }

    $r = new Room;
    $r->room_name = $req->room_name;
    $r->room_type_id = $req->room_type;
    $r->available_time_start = $req->start_time;
    $r->available_time_finish = $req->end_time;

    if ($r->save()) {
      $id = $r->id;
      $room_name = Room::where('id', $id)
                        ->first();
      
      $status = true;
      $message = $room_name->room_name . " is successfully added to your database!";
    } else {

      $status = false;
      $message = "Internal Server Error, please contact your developers.";

    }

    $data = array(
      'status' => $status,
      'message' => $message,
    );

    return json_encode($data);
  }

  public function overallShow(Request $req) {
    $type = $req->type;
    $id = $req->id;

    if ($type == 'room') {
      $r = Room::where('id', $id)
                ->first();

      $data = array(
        'data' => $r,
        'status' => true,
      );
    }

    else if ($type == 'course') {
      $c = Course::where('id', $id)
                  ->first();

      $courses = Course::where('academic_year', $c->academic_year)
                        ->where('semester', $c->semester)
                        ->where('title', $c->title)
                        ->get();

      $prog_name = Program::where('id', $c->program_id)
                            ->first();
      $prog_name = $prog_name->title;

      $ay = AcademicYear::where('id', $c->academic_year)
                          ->first()->academic_year;

      $status = true;

      $data = array(
        'course' => $c,
        'ay' => $ay,
        'program' => $prog_name,
        'status' => $status,
        'teacher' => $courses,
      );
    }

    else if ($type == 'program') {
      $p = Program::where('id', $id)
                    ->first();

      $ay_id = $p->academic_year_id;

      $ay = AcademicYear::where('id', $ay_id)
                          ->first();

      if (empty($ay)) {
        $ay = "This academic year doest exist anymore.";
      } else {
        $ay = $ay->academic_year;
      }

      $data = array(
        'ay' => $ay,
        'p' => $p,
        'status' => true,
      );
    }

    return json_encode($data);
  }

  public function addProgram(Request $req) {
    
    $validator = Validator::make($req->all(), [
      'academic_year' => 'required',
      'level'         => 'required|numeric|min:1|max:5',
      'title'         => 'required',
    ]);

    if ($validator->fails()) {
      $status = false;

      $data = array(
        'status' => $status,
        'errors' => $validator->errors()->all(),
      );

      return json_encode($data);
    }

    $p = new Program;
    $p->title = $req->title;
    $p->description = $req->description;
    $p->levels = $req->level;
    $p->academic_year_id = $req->academic_year;

    if ($p->save()) {
      $id = $p->id;
      $prog_title = Program::where('id', $id)
                            ->first();
      $prog_title = $prog_title->title;

      $status = true;
      $message = $prog_title . " is successfully stored";
    }

    $data = array(
      'status'  => $status,
      'message' => $message,
    );

    return json_encode($data);
  }

  public function generateFormSchedules(Request $req) {
    
    $validator = Validator::make($req->all(), [
      'academic_year' => 'required',
      'semester' => 'required',
      'program' => 'required',
      'level' => 'required',
    ]);

    if ($validator->fails()) {
      $status = false;

      $data = array(
        'status' => $status,
        'errors' => $validator->errors()->all(),
      );

      return json_encode($data);
    }

    $c = Course::where('program_id', $req->program)
                ->where('academic_year', $req->academic_year)
                ->where('semester', $req->semester)
                ->where('level', $req->level)
                ->get();

    if (count($c) == 0) {
      $status = 'no data';
      $message = "Kindly add the subjects binded to course you've selected.";
      
      $data = array(
        'status' => $status,
        'message' => $message,
      );

      return json_encode($data);
    }

    $prog_name = Program::where('id', $req->program)
                          ->first()->title;

    $course_title = array();
    $teacher_id = array();

    foreach ($c as $item) {
       
       if (empty($course_title)) {
         array_push($course_title, $item->title);

       } else if (in_array($item->title, $course_title)) {

       } else {
          array_push($course_title, $item->title);
       }

    }

    foreach ($course_title as $item) {
      
      $course_teacher = Course::where('title', $item)
                                ->get();

      $title_id = Course::where('title', $item)
                          ->first()->id;

      foreach ($course_teacher as $value) {
        
        $fullname = $value->teacher;
        $fullname = explode(' ', $fullname);
        $fn = $fullname[0];
        $ln = $fullname[1];

        $t_id = Teacher::where('first_name', $fn)
                      ->where('last_name', $ln)
                      ->first()->id;

        array_push($teacher_id, $t_id);
      }

      $data['title'][] = array(
        'teachers' => $course_teacher,
        'teacher_id' => $teacher_id,
        'title' => $item,
        'title_id' => $title_id,
      );

      $teacher_id = array();
    }

    $data['status'] = array(
      'status' => true,
      'program_name' => $prog_name,
    );

    return json_encode($data);
  }

  public function getLevels(Request $req) {
    $p = Program::where('id', $req->id)->first();
    $level = $p->levels;

    $data = array(
      'status' => true,
      'level' => $level,
    );

    return json_encode($data);
  }

  public function teacherAvailableDay(Request $req) {
    $at = AvailableTime::where('teacher_id', $req->id)
                        ->get();

    $s = Schedule::where('teacher_id', $req->id)
                        ->get();

    $data = array(
      'available_day' => $at,
      'assigned_day' => $s,
    );

    return json_encode($data);
  }

  public function getAvailableRooms(Request $req) {
    $r = Room::select('*')
              ->orderBy('available_time_start')
              ->get();

    return json_encode($r);
  }

  public function getUnavailableTime(Request $req) {
    $u_rooms = Schedule::where('room_id', $req->room)
                        ->where('day_of_week', $req->day)
                        ->where('academic_year_id', $req->ay)
                        ->where('semester', $req->sem)
                        ->where('id', '!=', $req->sched_id)
                        ->get();


    return json_encode($u_rooms);
  }

  public function saveChanges(Request $req) {
    $validator = Validator::make($req->all(), [
      'time_start' => 'required'
    ]);

    if ($validator->fails()) {
      $status = false;

      $data = array(
        'status' => $status,
        'errors' => $validator->errors()->all(),
      );

      return json_encode($data);
    }

    $s = Schedule::where('id', $req->id)
                  ->first();

    $s->room_id = $req->room;
    $s->time_start = $req->time_start;
    $s->time_finish = $req->time_finish;
    $s->day_of_week = $req->day;

    if ($s->save()) {
      $status = true;
    }

    return json_encode($status);
  }

  public function cancelInitialSchedule(Request $req) {
    $s = Schedule::where('id', $req->id)
                    ->first();

    $del_s = Schedule::where('academic_year_id', $s->academic_year_id)
                      ->where('semester', $s->semester)
                      ->where('program_id', $s->program_id)
                      ->where('level', $s->level)
                      ->get();

    foreach ($del_s as $item) {
      $s = Schedule::where('id', $item->id)
                      ->first();

      if ($s->delete()) {
        $status = true;
        $message = "The process canceled successfully.";

      } else {
        $status = false;

      }
    }

    $data = array(
      'status' => $status,
      'message' => $message,
    );

    return json_encode($data);
  }

  public function storeFixedSchedule(Request $req) {
    $s = Schedule::where('academic_year_id', $req->ay)
                  ->where('semester', $req->sem)
                  ->where('program_id', $req->id)
                  ->where('level', $req->lev)
                  ->get();

    // get real value of teacher, room, course, program?
    foreach ($s as $item) {
      $t = Teacher::where('id', $item->teacher_id)->first();
      $t_fullname = $t->first_name . ' ' . $t->last_name;

      $r = Room::where('id', $item->room_id)->first()->room_name;

      $c = Course::where('id', $item->course_id)->first()->title;

      $data['sched'][] = array(
        'raw-schedule' => $item,
        'teacher' => $t_fullname,
        'room' => $r,
        'course' => $c,
      );
    }

    foreach ($data['sched'] as $val) {
      $fs = new FixedSchedule;
      $fs->academic_year_id = $val['raw-schedule']->academic_year_id;
      $fs->semester = $val['raw-schedule']->semester;
      $fs->program_id = $val['raw-schedule']->program_id;
      $fs->course_name = $val['course'];
      $fs->teacher_name = $val['teacher'];
      $fs->room_name = $val['room'];
      $fs->level = $val['raw-schedule']->level;
      $fs->day = $val['raw-schedule']->day_of_week;
      $fs->time_start = $val['raw-schedule']->time_start;
      $fs->time_finish = $val['raw-schedule']->time_finish;

      if ($fs->save()) {
        $status = true;

      } else {
        $status = false;
      }

      if ($status == false) {
        return json_encode("Internal Server Error, please contact the main developer.");
      } 
    }

    return json_encode($status);
  }

  public function importProgram(Request $request) 
    {
      //checks if file is present
      if(request()->file('excelFile'))
      {
        $excel = $request->file('excelFile');
      Excel::import(new ProgramsImport, $excel, \Maatwebsite\Excel\Excel::XLSX);
        
        return back();
      }
      else{
        return back();
      }
      
    }

    public function importTeacher(Request $request) 
    {
      //checks if file is present
      if(request()->file('excelFile'))
      {
        $excel = $request->file('excelFile');
      Excel::import(new TeachersImport, $excel, \Maatwebsite\Excel\Excel::XLSX);
        
        return back();
      }
      else{
        return back();
      }
      
    }

    public function importRoom(Request $request) 
    {
      //checks if file is present
      if(request()->file('excelFile'))
      {
        $excel = $request->file('excelFile');
      Excel::import(new RoomsImport, $excel, \Maatwebsite\Excel\Excel::XLSX);
        
        return back();
      }
      else{
        return back();
      }
      
    }

    public function importCourse(Request $request) 
    {
      //checks if file is present
      if(request()->file('excelFile'))
      {
        $excel = $request->file('excelFile');
      Excel::import(new CoursesImport, $excel, \Maatwebsite\Excel\Excel::XLSX);
        
        return back();
      }
      else{
        return back();
      }
      
    }

    public function importAvailableTime(Request $request) 
    {
      //checks if file is present
      if(request()->file('excelFile'))
      {
        $excel = $request->file('excelFile');
      Excel::import(new TeachersAvailabilityImport, $excel, \Maatwebsite\Excel\Excel::XLSX);
        
        return back();
      }
      else{
        return back();
      }
      
    }
    



}

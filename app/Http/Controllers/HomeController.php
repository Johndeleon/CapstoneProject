<?php

namespace App\Http\Controllers;
use App\Program;
use App\Course;
use App\TeacherCourse;
use App\Teacher;
use App\Room;
use App\Semester;
use App\Schedule;
use App\RoomType;
use App\CourseCategory;
use Carbon\Carbon;
use App\AcademicYear;
use App\AvailableTime;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Validator;

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

    return view('admin.programs',compact('programs','accessLevel'));
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

public function addProgram(Request $request)
{

    $program= new Program();
    $program->title = $request->title;
    $program->description = $request->description;
    $program->levels = $request->levels;
    $program->year = 1;
    $program->save();


    return redirect()->back();

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
    ->get();


    return view('admin.courses',compact('courses'))->with('accessLevel', $accessLevel)
                          ->with('sidebar', $sidebar);
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

public function deleteCourse($id)
{
    $courseDeletion = Course::where('id',$id)
                            ->first();
    $courseDeletion->deleted_at = Carbon::now();
    $courseDeletion->save();

    return redirect('admin/courses');
}
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
      $academicYears = AcademicYear::all()->sortByDesc('created_at');
      $programs = Program::where('deleted_at',null)
      ->get();

      $hasSchedule = [];
      foreach($programs as $program)
      {
        for($i=1;$i<=$program->levels;$i++)
        {
            $isPresent = Schedule::where('program_id',$program->id)
            ->where('level',$i)
            ->count();

            if($isPresent != 0)
            {
                $hasSchedule[$program->id][$i] = 'enabled';
            }
            else
            {
                $hasSchedule[$program->id][$i] = 'disabled';
            }
        }
      }

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

      return view('admin.adminDashboard')->with('academicYears', $academicYears)
                                        ->with('programs', $programs)
                                        ->with('accessLevel', $accessLevel)
                                        ->with('sidebar', $sidebar)
                                        ->with('hasSchedule',$hasSchedule);
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

      $academicYears = AcademicYear::where('deleted_at',null)
      ->get()
      ->sortByDesc('created_at');

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
        'teacher' => $teacher,
        'course' => $course,
        'room' => $room
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

}

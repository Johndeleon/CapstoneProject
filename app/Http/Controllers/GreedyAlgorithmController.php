<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Teacher;
use App\User;
use DB;
use Carbon\Carbon;
use App\Room;
use App\AvailableTime;
use App\Schedule;
use App\Course;
use App\Program;
use App\AcademicYear;

class GreedyAlgorithmController extends Controller
{

    public function generateSchedule(Request $request)
    {
        $program_title = $request->program_title;
        $program_id = Program::select('id')
                              ->where('title', $program_title)
                              ->where('deleted_at', null)
                              ->pluck('id');

        $program_id = $program_id[0];
        $level = $request->level;
        $roomType= $request->roomtype;
        $aY = $request->academic_year;

        $aY_id = AcademicYear::select('id')
                              ->where('academic_year', $aY)
                              ->where('deleted_at', null)
                              ->pluck('id');
        $aY_id = $aY_id[0];

        $semester = $request->semester;
        $courses = $request->courses;
        $teachers = $request->teachers;
        $totalHours = $request->total_hours;
        $meetings = $request->meeting;

        // return $request->all();

        $numCourses = count($courses);

        $days_of_week = ['monday','tuesday','wendesday','thursday','friday','saturday'];


        $timeStart = [630,700,730,800,830,900,930,1000,1030,1100,1130,1200,1230,1300,1330,1400,1430,1500,1530,1600,1630,1700,1730,1800,1830,1900];
        $initProgSched = array();


            print_r($courses);
            print('<br>');
            print_r($meetings);
            print('<br>');
            print_r($totalHours);
            print('<br>');
            print_r($teachers);
            print('<br>');
            print_r($numCourses);
            print('<br>');
            print_r($roomType);
            print('<br>');
            print('<br>');


        //course loop
        for($i = 0; $i < $numCourses; $i++)
        {
            $dailyHours = [];
            $course = Course::select('id')
            ->where('title',$courses[$i])
            ->first();


            if($meetings[$i] == 1 && $totalHours[$i] == 2)
                {
                    $dailyHours[] = 200;
                }
            elseif($meetings[$i] == 2 && $totalHours[$i] == 2)
                {
                    $dailyHours[] = 100;
                    $dailyHours[] = 100;
                }
            elseif($meetings[$i] == 3 && $totalHours[$i] == 2)
                {
                    $meetings[$i] = 2;
                    $dailyHours[] = 100;
                    $dailyHours[] = 100;
                }
            elseif($meetings[$i] == 1 && $totalHours[$i] == 3)
                {
                    $dailyHours[] = 300;
                }
            elseif($meetings[$i] == 2 && $totalHours[$i] == 3)
                {
                    $dailyHours[] = 150;
                    $dailyHours[] = 150;
                }
            elseif($meetings[$i] == 3 && $totalHours[$i] == 3)
                {
                    $dailyHours[] = 100;
                    $dailyHours[] = 100;
                    $dailyHours[] = 100;
                }
            elseif($meetings[$i] == 1 && $totalHours[$i] == 4)
                {
                    $dailyHours[] = 400;
                }
            elseif($meetings[$i] == 2 && $totalHours[$i] == 4)
                {
                    $dailyHours[] = 200;
                    $dailyHours[] = 200;
                }
            elseif($meetings[$i] == 3 && $totalHours[$i] == 4)
                {
                    $dailyHours[] = 150;
                    $dailyHours[] = 150;
                    $dailyHours[] = 100;
                }
            elseif($meetings[$i] == 1 && $totalHours[$i] == 5)
                {
                    $dailyHours[] = 500;
                }
            elseif($meetings[$i] == 2 && $totalHours[$i] == 5)
                {
                    $dailyHours[] = 250;
                    $dailyHours[] = 250;
                }
            elseif($meetings[$i] == 3 && $totalHours[$i] == 5)
                {
                    $dailyHours[] = 150;
                    $dailyHours[] = 150;
                    $dailyHours[] = 200;
                }




            //meeting loop
            for($j = 0; $j < $meetings[$i]; $j++)
            {
                $loopControl = 0;

                $dbteachers = Teacher::select('id',DB::raw("CONCAT(first_name,' ',last_name) AS fullName"))
                ->where('deleted_at',null)
                ->get();

                foreach($dbteachers as $teacher)
               {
                    if($teachers[$i] == $teacher->fullName)
                    {
                        $teacherId = $teacher->id;
                        break;
                    }
               }

                //if initsched is empty
                if(empty($initSched))
                {
                    //day loop
                    for($day = 1;$day < 7; $day++)
                    {
                        //get all the available days of the teacher
                        $selectedDay = AvailableTime::where('teacher_id',$teacherId)
                        ->where('available_day',$day)
                        ->where('deleted_at',null)
                        ->first();

                        if($selectedDay != null)
                        {
                        //adds n mnumber of hours to the time start based on the number of meetings per week


                    //time loop
                        for ($k = 0 ; $k < count($timeStart);$k++)
                            {

                                if(substr($timeStart[$k],-2) == 30 && $dailyHours[$j] == 150)
                                {
                                    $timeFinish = $timeStart[$k] + 170;
                                }
                                elseif(substr($timeStart[$k],-2) == 00 && $dailyHours[$j] == 150)
                                {
                                    $timeFinish = $timeStart[$k] + 130;
                                }
                                elseif(substr($timeStart[$k],-2) == 30 && $dailyHours[$j] == 250)
                                {
                                    $timeFinish = $timeStart[$k] + 270;
                                }
                                elseif(substr($timeStart[$k],-2) == 00 && $dailyHours[$j] == 250)
                                {
                                    $timeFinish = $timeStart[$k] + 230;
                                }
                                else
                                {
                                    $timeFinish = $timeStart[$k] + $dailyHours[$j];
                                }

                                //selects * available time of teacher with the selected day
                                $availableTimes = AvailableTime::select('time_start','time_finish')
                                ->where('available_day',$selectedDay->available_day)
                                ->where('deleted_at',null)
                                ->where('teacher_id',$teacherId)
                                ->first();

                                $teacherSchedules = Schedule::where('teacher_id',$teacherId)
                                ->where('day_of_week',$selectedDay->available_day)
                                ->where('semester',$semester)
                                ->get();

                                    //compares the current timestart and time finish if they are within the teachers time availability
                                if($timeStart[$k] >= $availableTimes->time_start && $timeFinish <= $availableTimes->time_finish && isset($teacherSchedules))
                                {
                                        $conflict = 0;

                                            foreach($teacherSchedules as $schedule)
                                            {
                                                if($timeStart[$k] >= $schedule->time_start && $timeStart[$k] <= $schedule->time_finish || $timeFinish >= $schedule->time_start && $timeFinish <= $schedule->time_finish)
                                                {
                                                    $conflict = 1;
                                                }
                                            }

                                        if($conflict == 0)
                                        {

                                            $selectedTime = $timeStart[$k].' - '.$timeFinish;


                                            $rooms = Room::where('room_type_id',$roomType)
                                            ->where('deleted_at',null)
                                            ->get();

                                            //selecting the room
                                            foreach($rooms as $room)
                                            {
                                            if ($timeStart[$k] >= $room->available_time_start && $timeFinish <= $room->available_time_finish )
                                                {

                                                    $selectedRoom = $room->id;

                                                    $conflict = 0;
                                                    foreach($teacherSchedules as $schedule)
                                                    {
                                                        if($room->available_time_start >= $schedule->time_start || $room->available_time_finish  <= $schedule->time_finish)
                                                            {
                                                                $conflict =1;
                                                            }
                                                    }


                                                    $roomSchedules = Schedule::where('day_of_week',$selectedDay->available_day)
                                                    ->where('room_id',$room->id)
                                                    ->where('deleted_at',null)
                                                    ->get();

                                                    foreach($roomSchedules as $schedule)
                                                    {
                                                        if(($timeStart[$k] >= $schedule->time_start && $timeStart[$k] <= $timeFinish) || ($timeFinish >= $schedule->time_start && $timeFinish <= $timeFinish))
                                                        {
                                                            $conflict = 1;
                                                        }
                                                    }

                                                    if($conflict == 0)
                                                    {

                                                        $course = Course::select('id')
                                                        ->where('title',$courses[$i])
                                                        ->where('deleted_at',null)
                                                        ->first();

                                                        $initCourseSched = [
                                                            'academic_year_id' => $aY_id,
                                                            'semester' => 1,
                                                            'program_id' => $program_id,
                                                            'level' => $level,
                                                            'course_id' => $course->id,
                                                            'teacher_id' => $teacherId,
                                                            'room_id' => $selectedRoom,
                                                            'day_of_week' => $selectedDay->available_day,
                                                            'time_start' => $timeStart[$k],
                                                            'time_finish' => $timeFinish
                                                        ];

                                                        $initProgSched[] = $initCourseSched;
                                                        $initSched = json_encode($initProgSched);

                                                        $loopControl = 1;
                                                    }

                                                    if($loopControl == 1)
                                                    {
                                                        break;
                                                    }
                                                }
                                            if($loopControl == 1)
                                            {
                                                break;
                                            }
                                        }
                                        if($loopControl == 1)
                                        {
                                            break;
                                        }
                                    }
                                    if($loopControl == 1)
                                    {
                                        break;
                                    }


                                }
                                if($loopControl == 1)
                                {
                                    break;
                                }

                                }

                        }
                        if($loopControl == 1)
                        {
                            break;
                        }
                    }
               }
               else
               {
                for($day = 1;$day <= 6; $day++)
                {
                    //get all the available days of the teacher
                    $selectedDay = AvailableTime::where('teacher_id',$teacherId)
                    ->where('available_day',$day)
                    ->where('deleted_at',null)
                    ->first();

                    if($selectedDay != null)
                    {
                        $tooManyMeeting = 0;

                        for($z=0;$z<count($initProgSched);$z++)
                        {
                            if($course->id == $initProgSched[$z]['course_id'] && $selectedDay['available_day'] == $initProgSched[$z]['day_of_week'])
                            {
                                $tooManyMeeting = 1;
                            }

                        }

                        if($tooManyMeeting == 0)
                        {

                            for ($k = 0 ; $k < count($timeStart);$k++)
                                {
                                    if(substr($timeStart[$k],-2) == 30 && $dailyHours[$j] == 150)
                                    {
                                        $timeFinish = $timeStart[$k] + 170;
                                    }
                                    elseif(substr($timeStart[$k],-2) == 00 && $dailyHours[$j] == 150)
                                    {
                                        $timeFinish = $timeStart[$k] + 130;
                                    }
                                    elseif(substr($timeStart[$k],-2) == 30 && $dailyHours[$j] == 250)
                                    {
                                        $timeFinish = $timeStart[$k] + 270;
                                    }
                                    elseif(substr($timeStart[$k],-2) == 00 && $dailyHours[$j] == 250)
                                    {
                                        $timeFinish = $timeStart[$k] + 230;
                                    }
                                    else
                                    {
                                        $timeFinish = $timeStart[$k] + $dailyHours[$j];
                                    }


                                    //selects * available time of teacher with the selected day
                                    $availableTimes = AvailableTime::select('time_start','time_finish')
                                    ->where('available_day',$selectedDay['available_day'])
                                    ->where('deleted_at',null)
                                    ->where('teacher_id',$teacherId)
                                    ->first();

                                    $teacherSchedules = Schedule::where('teacher_id',$teacherId)
                                    ->where('day_of_week',$selectedDay->available_day)
                                    ->where('semester',$semester)
                                    ->get();
                                        //compares the current timestart and time finish if they are within the teachers time availability
                                    if($timeStart[$k] >= $availableTimes['time_start'] && $timeFinish <= $availableTimes['time_finish'])
                                    {
                                            $conflict = 0;
                                                foreach($teacherSchedules as $schedule)
                                                {
                                                if($timeStart[$k] >= $schedule->time_start && $timeStart[$k] <= $schedule->time_finish || $timeFinish >= $schedule->time_start && $timeFinish <= $schedule->time_finish)
                                                    {
                                                        $conflict = 1;
                                                    }
                                                }

                                                for($y = 0;$y < count($initProgSched);$y++)
                                                {
                                                    if($teacherId == $initProgSched[$y]['teacher_id'] &&
                                                    $selectedDay->available_day == $initProgSched[$y]['day_of_week'] &&
                                                    $timeStart[$k] >= $initProgSched[$y]['time_start'] &&
                                                    $timeStart[$k] <= $initProgSched[$y]['time_finish']
                                                )
                                                    {
                                                        $conflict = 1;
                                                    }
                                                }

                                                for($y = 0;$y < count($initProgSched);$y++)
                                                {
                                                    if($teacherId == $initProgSched[$y]['teacher_id'] &&
                                                    $selectedDay->available_day == $initProgSched[$y]['day_of_week'] &&
                                                    $timeFinish >= $initProgSched[$y]['time_start'] &&
                                                    $timeFinish <= $initProgSched[$y]['time_finish']
                                                )
                                                    {
                                                        $conflict = 1;
                                                    }
                                                }

                                                if($timeFinish > 1800)
                                                {
                                                    $conflict = 1;
                                                }

                                            if($conflict == 0)
                                            {

                                                 $rooms = Room::where('room_type_id',$roomType[$i])
                                                 ->where('deleted_at',null)
                                                 ->get();

                                                 $schedules = Schedule::where('academic_year_id',$aY)
                                                 ->where('semester',$semester)
                                                 ->where('room_id',$roomType[$i])
                                                 ->where('deleted_at',null)
                                                 ->get();

                                                //selecting the room
                                                foreach($rooms as $room)
                                                {

                                                if ($timeStart[$k] >= $room->available_time_start && $timeFinish <= $room->available_time_finish )
                                                    {

                                                        $selectedRoom = $room->id;

                                                        $conflict = 0;

                                                        for($x = 0;$x < count($initProgSched);$x++)
                                                        {
                                                            if($selectedRoom == $initProgSched[$x]['room_id'] &&
                                                               $timeStart[$k] >= $initProgSched[$x]['time_start'] &&
                                                               $timeStart[$k] <= $initProgSched[$x]['time_finish'])
                                                            {
                                                                $conflict = 1;
                                                            }

                                                            if($selectedRoom == $initProgSched[$x]['room_id'] &&
                                                               $timeFinish >= $initProgSched[$x]['time_start'] &&
                                                               $timeFinish <= $initProgSched[$x]['time_finish'])
                                                            {
                                                                $conflict = 1;
                                                            }
                                                        }



                                                    $roomSchedules = Schedule::where('day_of_week',$selectedDay->available_day)
                                                    ->where('room_id',$room->id)
                                                    ->where('deleted_at',null)
                                                    ->get();

                                                    foreach($roomSchedules as $schedule)
                                                    {
                                                        if(($timeStart[$k] >= $schedule->time_start && $timeStart[$k] <= $timeFinish) || ($timeFinish >= $schedule->time_start && $timeFinish <= $timeFinish))
                                                        {
                                                            $conflict = 1;
                                                        }
                                                    }


                                                        if($conflict == 0)
                                                        {

                                                            $course = Course::select('id')
                                                            ->where('title',$courses[$i])
                                                            ->where('deleted_at',null)
                                                            ->first();

                                                            $initCourseSched = [
                                                                'academic_year_id' => $aY_id,
                                                                'semester' => $semester,
                                                                'program_id' => $program_id,
                                                                'level' => $level,
                                                                'course_id' => $course->id,
                                                                'teacher_id' => $teacherId,
                                                                'room_id' => $selectedRoom,
                                                                'day_of_week' => $selectedDay->available_day,
                                                                'time_start' => $timeStart[$k],
                                                                'time_finish' => $timeFinish
                                                            ];


                                                            $initProgSched[] = $initCourseSched;
                                                            $initSched = json_encode($initProgSched);

                                                            $loopControl = 1;

                                                        }


                                                        if($loopControl == 1)
                                                        {
                                                            break;
                                                        }
                                                    }
                                                if($loopControl == 1)
                                                {
                                                    break;
                                                }
                                            }
                                            if($loopControl == 1)
                                            {
                                                break;
                                            }
                                        }
                                        if($loopControl == 1)
                                        {
                                            break;
                                        }


                                    }
                                    if($loopControl == 1)
                                    {
                                        break;
                                    }

                                   }



                            if($loopControl == 1)
                            {
                                break;
                            }

                        }
                    }
                }//day with json

               }//with json
            }//meeting

        }//course
        $sched = json_decode($initSched,true);
        $queueCount = count($sched);

        for($entry = 0;$entry < $queueCount;$entry++)
        {

                $save = new Schedule();
                $save->academic_year_id = $sched[$entry]['academic_year_id'];
                $save->semester = $sched[$entry]['semester'];
                $save->program_id = $sched[$entry]['program_id'];
                $save->level = $sched[$entry]['level'];
                $save->course_id = $sched[$entry]['course_id'];
                $save->teacher_id = $sched[$entry]['teacher_id'];
                $save->room_id = $sched[$entry]['room_id'];
                $save->day_of_week = $sched[$entry]['day_of_week'];
                $save->time_start = $sched[$entry]['time_start'];
                $save->time_finish = $sched[$entry]['time_finish'];
                $save->created_at = Carbon::now()->toDateTimeString();
                $save->save();

        }
        print(json_encode($teacherSchedules));        // return $request->all();

    }//class

}//controller

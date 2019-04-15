<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Teacher;
use App\User;
use DB;
use Carbon\Carbon;
use App\Room;
use App\RoomType;
use App\AvailableTime;
use App\Schedule;
use App\Course;
use App\Program;
use App\AcademicYear;

class BaseController extends Controller
{
    public function generateSchedule(Request $request)
    {

        $program_id = $request->program_title;
        $level = $request->level;
        $inputRoomType = $request->roomtype;
        $aY_id = $request->academic_year;
        $semester = $request->semester;
        $inputCourses = $request->courses;
        $inputTeachers = $request->teachers;
        $inputTotalHours = $request->total_hours;
        $inputMeetings = $request->meeting;

        $numCourses = count($inputCourses);
        $availableDayPerTeacher = [];
        $keyArrangement = [];
        $teachers = [];

        foreach($inputTeachers as $key => $teacher)
        {
            $count = AvailableTime::where('teacher_id',$teacher)
            ->where('deleted_at',null)
            ->count();
            $availableDayPerTeacher[$key][$teacher] = $count;
        }
        asort($availableDayPerTeacher); // xxhere Continue the analyzation here...
        foreach($availableDayPerTeacher as $key => $row)
        {
            $keyArrangement[]= $key;
        }

        for($i=$numCourses-1;$i>=0;$i--)
        {
            $toSearch = $keyArrangement[$i];
            $teachers[$i] = $inputTeachers[$toSearch];
        }

        for($i=$numCourses-1;$i>=0;$i--)
        {
            $toSearch = $keyArrangement[$i];
            $courses[$i] = $inputCourses[$toSearch];
        }

        for($i=$numCourses-1;$i>=0;$i--)
        {
            $toSearch = $keyArrangement[$i];
            $meetings[$i] = $inputMeetings[$toSearch];
        }

        for($i=$numCourses-1;$i>=0;$i--)
        {
            $toSearch = $keyArrangement[$i];
            $totalHours[$i] = $inputTotalHours[$toSearch];
        }

        for($i=$numCourses-1;$i>=0;$i--)
        {
            $toSearch = $keyArrangement[$i];
            $roomType[$i] = $inputRoomType[$toSearch];
        }



        $days_of_week = ['monday','tuesday','wendesday','thursday','friday','saturday'];


        $timeStart = [630,700,730,800,830,900,930,1000,1030,1100,1130,1200,1230,1300,1330,1400,1430,1500,1530,1600,1630,1700,1730,1800,1830,1900];
        $initProgSched = array();


        //course loop
        for($i = $numCourses-1; $i >= 0 ; $i--)
        {
            $dailyHours = [];

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

                //if initsched is empty
                if(empty($initSched))
                {
                    //day loop
                    for($day = 1;$day < 7; $day++)
                    {
                        //check if $day is available
                        $selectedDay = AvailableTime::where('teacher_id',$teachers[$i])
                        ->where('available_day',$day)
                        ->where('deleted_at',null)
                        ->first();

                        if($selectedDay != null)
                        {

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
                                ->where('teacher_id',$teachers[$i])
                                ->first();

                                $teacherSchedules = Schedule::where('teacher_id',$teachers[$i])
                                ->where('day_of_week',$selectedDay->available_day)
                                ->where('semester',$semester)
                                ->where('academic_year_id',$aY_id)
                                ->get();

                                    //compares the current timestart and time finish if they are within the teachers time availability
                                if($timeStart[$k] >= $availableTimes->time_start && $timeStart[$k] <= $availableTimes->time_finish && $timeFinish >= $availableTimes->time_start && $timeFinish <= $availableTimes->time_finish && isset($teacherSchedules))
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

                                                        $initCourseSched = [
                                                            'academic_year_id' => $aY_id,
                                                            'semester' => $semester,
                                                            'program_id' => $program_id,
                                                            'level' => $level,
                                                            'course_id' => $courses[$i],
                                                            'teacher_id' => $teachers[$i],
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
                    $selectedDay = AvailableTime::where('teacher_id',$teachers[$i])
                    ->where('available_day',$day)
                    ->where('deleted_at',null)
                    ->first();

                    if($selectedDay != null)
                    {
                        $tooManyMeeting = 0;

                        for($z=0;$z<count($initProgSched);$z++)
                        {
                            if($courses[$i] == $initProgSched[$z]['course_id'] && $selectedDay['available_day'] == $initProgSched[$z]['day_of_week'])
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
                                    ->where('teacher_id',$teachers[$i])
                                    ->first();

                                    $teacherSchedules = Schedule::where('teacher_id',$teachers[$i])
                                    ->where('day_of_week',$selectedDay->available_day)
                                    ->where('academic_year_id',$aY_id)
                                    ->where('semester',$semester)
                                    ->get();

                                        //compares the current timestart and time finish if they are within the teachers time availability
                                    if($timeStart[$k] >= $availableTimes['time_start'] && $timeStart[$k] <= $availableTimes['time_finish'] && $timeFinish >= $availableTimes['time_start'] && $timeFinish <= $availableTimes['time_finish'])
                                    {
                                            $conflict = 0;

                                            if($teacherSchedules != null)
                                            {
                                                foreach($teacherSchedules as $schedule)
                                                {
                                                if($timeStart[$k] >= $schedule->time_start && $timeStart[$k] <= $schedule->time_finish || $timeFinish >= $schedule->time_start && $timeFinish <= $schedule->time_finish)
                                                    {
                                                        $conflict = 1;
                                                    }
                                                }
                                            }
                                                for($y = 0;$y < count($initProgSched);$y++)
                                                {
                                                    if(
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
                                                    if(
                                                    $selectedDay->available_day == $initProgSched[$y]['day_of_week'] &&
                                                    $timeFinish >= $initProgSched[$y]['time_start'] &&
                                                    $timeFinish <= $initProgSched[$y]['time_finish']
                                                )
                                                    {
                                                        $conflict = 1;
                                                    }
                                                }

                                                if($timeFinish > 2000)
                                                {
                                                    $conflict = 1;
                                                }

                                            if($conflict == 0)
                                            {

                                                 $rooms = Room::where('room_type_id',$roomType[$i])
                                                 ->where('deleted_at',null)
                                                 ->get();

                                                 $schedules = Schedule::where('academic_year_id', $aY_id)
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

                                                            $initCourseSched = [
                                                                'academic_year_id' => $aY_id,
                                                                'semester' => $semester,
                                                                'program_id' => $program_id,
                                                                'level' => $level,
                                                                'course_id' => $courses[$i],
                                                                'teacher_id' => $teachers[$i],
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
                    }//a day matched with teachers availbility
                    if($loopControl == 0 && $day == 6)
                    {

                    }
                }//day with json

               }//with json
            }//meeting

        }//course
        $sched = json_decode($initSched, true);
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
        // print_r($keyArrangement);
        // print_r($teachers);
        // print_r($meetings);
        // print_r($totalHours);
        // print_r($courses);

        return $initSched;



        // return $request->all();

    }//class




}

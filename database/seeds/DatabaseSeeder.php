<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $timeStart = [630,700,730,800,830,900,930,1000,1030,1100,1130,1200,1230,1300,1330,1400,1430,1500,1530,1600,1630,1700,1730,1800,1830,1900];


        DB::table('users')->insert(
        	[
        		'name' => 'john doe',
                'email' => 'angularjohn@gmail.com',
                'access_level' => 1,
                'password' => bcrypt('asdfasdf'),
                'created_at' => Carbon::now(),
        	]
        );
        DB::table('users')->insert(
        	[
        		'name' => 'jane doe',
                'email' => 'jane@gmail.com',
                'access_level' => 2,
                'password' => bcrypt('asdfasdf'),
                'created_at' => Carbon::now(),
        	]
        );
        DB::table('users')->insert(
        	[
        		'name' => 'james doe',
                'email' => 'james@gmail.com',
                'access_level' => 3,
                'password' => bcrypt('asdfasdf'),
                'name' => Carbon::now(),
        	]
        );

        DB::table('room_types')->insert(
        	[
        		'room_type' => 'Normal Room',
        		'created_at' => Carbon::now()
        	]
        );
        
        DB::table('room_types')->insert(
        	[
        		'room_type' => 'Laboratory Room',
        		'created_at' => Carbon::now()
        	]
        );

    
     //    $faker = Faker::create();

    	// $college = [
    	// 	'5 - Year BS in Accountancy',
     //        '4 - Year BS in Information Systems',
    	// 	'4 - Year BA in Broadcasting',
     //        '4 - Year BS in Accounting Technology',
     //        '4 - Year BS in Social Work',
    	// 	'2 - Year Associate in Computer Technology',
     //        'Office Managemenent',
     //        'Health Care Services NC II',
     //        'Cookery NC II'
     //    ];

     //    $levels = [
    	// 	'5',
     //        '4',
    	// 	'4',
     //        '4',
     //        '4',
    	// 	'2',
     //        '2',
     //        '1',
     //        '1'
    	// ];

     //    foreach (range(0, 7) as $index) {
     //        DB::table('programs')->insert([
     //            'title' => $college[$index],
     //            'levels' => $levels[$index],
     //            'description' => $faker->paragraph,
     //            'academic_year_id' => $index
     //        ]);
     //    }

       //  $faker = Faker::create();
       //  foreach (range(1, 10) as $index) {
       //  	DB::table('teachers')->insert([
			    // 'first_name' => $faker->firstName,
			    // 'last_name' => $faker->lastName,
			    // 'address' => $faker->address,
			    // 'contact_number' => $faker->phoneNumber,
       //          'email' => $faker->email
       //      ]);

       //      //num of available days
       //      $rand = rand(1,6);
       //      //what day
       //      for($y=1;$y<=$rand;$y++)
       //      {
       //          $randtime = rand(1,10);
       //          $rand1 = rand(1,6);
       //          DB::table('available_times')->insert([
       //              'teacher_id' => $index,
       //              'available_day' => $y,
       //              'time_start' => $timeStart[$randtime],
       //              'time_finish'  => 2000

       //          ]);
       //      }
    
       //  }


        // $faker = Faker::create();
        // $courses = [
        // 	'Mathematics',
        // 	'Science',
        // 	'Mobile Development',
        // 	'Software Engr',
        // 	'Project Management',
        // 	'Statistics',
        // 	'Essential Accounting',
        // 	'Capstone',
        // 	'Web Development',
        // 	'IS Innovation',
        // 	'IS Strategy',
        // 	'Physical Education',
        // 	'Physical Science',
        // 	'Algebra',
        // 	'Business Management'
        // ];

        // foreach (range(0, 14) as $index) {
        // 	DB::table('courses')->insert([
        //         'program_id' => 1,
        //         'academic_year' => '2018 - 2019',
        //         'semester' => 1,
        //         'teacher' => 'Sharene Labung',
		      //   'title' => $courses[$index],
		      //   'code' => $faker->word. ' ' . $faker->randomDigit,
		      //   'units' => $faker->randomDigit,
        //     ]);

        // }

        // for ($z=1;$z<=30;$z++) {
        //     $randtime = rand(0,5);


        //     DB::table('rooms')->insert([
        //         'room_name' => 'dsr'.$z,
        //         'room_type_id' => 1,
        //         'available_time_start' => $timeStart[$randtime],
        //         'available_time_finish' => 2000
        //     ]);

            
        // }

        // for ($z=1;$z<=4;$z++) {
        //     $randtime = rand(0,11);


        // DB::table('rooms')->insert([
        //     'room_name' => 'comlab'.$z,
        //     'room_type_id' => 2,
        //     'available_time_start' => $timeStart[$randtime],
        //     'available_time_finish' => 2000
        // ]);

        
   // }

       
    }
}

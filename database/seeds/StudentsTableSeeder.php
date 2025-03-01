<?php

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();

        $students = [
            ['name' => ['en' => 'Ali', 'ar' => 'علي محمد'], 'email' => 'alistudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 1, 'Date_Birth' => '2010-05-12', 'Grade_id' => 1, 'Classroom_id' => 2, 'section_id' => 1, 'parent_id' => 1, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Sara', 'ar' => 'سارة أحمد'], 'email' => 'sarastudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 2, 'Date_Birth' => '2011-03-08', 'Grade_id' => 2, 'Classroom_id' => 1, 'section_id' => 3, 'parent_id' => 1, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Hassan', 'ar' => 'حسن يوسف'], 'email' => 'hassanstudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 1, 'Date_Birth' => '2012-07-19', 'Grade_id' => 3, 'Classroom_id' => 5, 'section_id' => 2, 'parent_id' => 1, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Lina', 'ar' => 'لينا سمير'], 'email' => 'linastudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 2, 'Date_Birth' => '2009-11-25', 'Grade_id' => 1, 'Classroom_id' => 4, 'section_id' => 1, 'parent_id' => 4, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Omar', 'ar' => 'عمر خالد'], 'email' => 'omarstudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 1, 'Date_Birth' => '2013-02-14', 'Grade_id' => 2, 'Classroom_id' => 3, 'section_id' => 2, 'parent_id' => 5, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Maya', 'ar' => 'مايا نبيل'], 'email' => 'mayastudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 2, 'Date_Birth' => '2011-09-30', 'Grade_id' => 3, 'Classroom_id' => 6, 'section_id' => 3, 'parent_id' => 6, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Yousef', 'ar' => 'يوسف إبراهيم'], 'email' => 'yousefstudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 1, 'Date_Birth' => '2008-06-05', 'Grade_id' => 1, 'Classroom_id' => 7, 'section_id' => 1, 'parent_id' => 7, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Nour', 'ar' => 'نور محمد'], 'email' => 'nourstudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 2, 'Date_Birth' => '2010-04-22', 'Grade_id' => 2, 'Classroom_id' => 8, 'section_id' => 2, 'parent_id' => 8, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Khaled', 'ar' => 'خالد محمود'], 'email' => 'khaledstudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 1, 'Date_Birth' => '2012-01-17', 'Grade_id' => 3, 'Classroom_id' => 9, 'section_id' => 3, 'parent_id' => 9, 'academic_year' => '2024/2025'],
            ['name' => ['en' => 'Hana', 'ar' => 'هناء جاسم'], 'email' => 'hanastudent@gmail.com', 'password' => Hash::make('student1234'), 'gender_id' => 2, 'Date_Birth' => '2014-08-12', 'Grade_id' => 1, 'Classroom_id' => 10, 'section_id' => 1, 'parent_id' => 10, 'academic_year' => '2024/2025'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}

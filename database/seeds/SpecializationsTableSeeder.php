<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en'=> 'Arabic Language', 'ar'=> 'لغة عربية'],
            ['en'=> 'English Language', 'ar'=> 'لغة إنجليزية'],
            ['en'=> 'Islamic Education', 'ar'=> 'تربية إسلامية'],
            ['en'=> 'Science and Life', 'ar'=> 'علوم وحياة'],
            ['en'=> 'Mathematics', 'ar'=> 'رياضيات '],
            ['en'=> 'Social Studies (Geography)', 'ar'=> 'دراسات اجتماعية (جغرافيا)'],
            ['en'=> 'Technology', 'ar'=> 'التكنولوجيا'],
            ['en'=> 'Physics', 'ar'=> 'فيزياء'],
            ['en'=> 'Chemistry', 'ar'=> 'كيمياء'],
            ['en'=> 'Biology', 'ar'=> 'أحياء'],
            ['en'=> 'History', 'ar'=> 'تاريخ'],
        ];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }
    }
}

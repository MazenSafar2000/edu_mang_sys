<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use UserSeeder;
use GradeSeeder;
use ClassroomTableSeeder;
use SectionsTableSeeder;
use SpecializationsTableSeeder;
use GenderTableSeeder;
use ParentsTableSeeder;
use StudentsTableSeeder;
use SettingsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(ParentsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
    }
}

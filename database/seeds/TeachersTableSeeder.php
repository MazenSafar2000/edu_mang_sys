<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        DB::table('teachers')->delete();

        $teachers = [
            ['email' => 'ahmed1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Ahmed Ahmed', 'ar' => 'أحمد أحمد'], 'Specialization_id' => 1, 'Gender_id' => 1, 'Joining_Date' => '2023-01-01', 'Address' => 'Cairo, Egypt', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'ahmed2@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Ahmed Ali', 'ar' => 'أحمد علي'], 'Specialization_id' => 1, 'Gender_id' => 1, 'Joining_Date' => '2023-02-01', 'Address' => 'Giza, Egypt', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'ahmed3@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Ahmed Hassan', 'ar' => 'أحمد حسن'], 'Specialization_id' => 1, 'Gender_id' => 1, 'Joining_Date' => '2023-03-01', 'Address' => 'Alexandria, Egypt', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'ali1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Ali Ali', 'ar' => 'علي علي'], 'Specialization_id' => 2, 'Gender_id' => 1, 'Joining_Date' => '2023-04-01', 'Address' => 'Riyadh, Saudi Arabia', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'ali2@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Ali Hassan', 'ar' => 'علي حسن'], 'Specialization_id' => 2, 'Gender_id' => 1, 'Joining_Date' => '2023-05-01', 'Address' => 'Jeddah, Saudi Arabia', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'ali3@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Ali Omar', 'ar' => 'علي عمر'], 'Specialization_id' => 2, 'Gender_id' => 1, 'Joining_Date' => '2023-06-01', 'Address' => 'Dubai, UAE', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'mohamed1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Mohamed Mohamed', 'ar' => 'محمد محمد'], 'Specialization_id' => 3, 'Gender_id' => 1, 'Joining_Date' => '2023-07-01', 'Address' => 'Abu Dhabi, UAE', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'mohamed2@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Mohamed Saeed', 'ar' => 'محمد سعيد'], 'Specialization_id' => 3, 'Gender_id' => 1, 'Joining_Date' => '2023-08-01', 'Address' => 'Manama, Bahrain', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'khalid1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Khalid Khalid', 'ar' => 'خالد خالد'], 'Specialization_id' => 4, 'Gender_id' => 1, 'Joining_Date' => '2023-09-01', 'Address' => 'Muscat, Oman', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'omar1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Omar Omar', 'ar' => 'عمر عمر'], 'Specialization_id' => 5, 'Gender_id' => 1, 'Joining_Date' => '2023-10-01', 'Address' => 'Doha, Qatar', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'hassan1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Hassan Hassan', 'ar' => 'حسن حسن'], 'Specialization_id' => 5, 'Gender_id' => 1, 'Joining_Date' => '2023-11-01', 'Address' => 'Kuwait City, Kuwait', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'saeed1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Saeed Saeed', 'ar' => 'سعيد سعيد'], 'Specialization_id' => 6, 'Gender_id' => 1, 'Joining_Date' => '2023-12-01', 'Address' => 'Amman, Jordan', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'nader1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Nader Nader', 'ar' => 'نادر نادر'], 'Specialization_id' => 7, 'Gender_id' => 1, 'Joining_Date' => '2024-01-01', 'Address' => 'Beirut, Lebanon', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'samir1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Samir Samir', 'ar' => 'سمير سمير'], 'Specialization_id' => 7, 'Gender_id' => 1, 'Joining_Date' => '2024-02-01', 'Address' => 'Damascus, Syria', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'rami1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Rami Rami', 'ar' => 'رامي رامي'], 'Specialization_id' => 7, 'Gender_id' => 1, 'Joining_Date' => '2024-03-01', 'Address' => 'Baghdad, Iraq', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'nader2@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Nader Hasan', 'ar' => 'نادر حسن'], 'Specialization_id' => 8, 'Gender_id' => 1, 'Joining_Date' => '2023-12-01', 'Address' => 'Beirut, Lebanon', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'samir2@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Samir Saeed', 'ar' => 'سمير سعيد'], 'Specialization_id' => 8, 'Gender_id' => 1, 'Joining_Date' => '2024-01-01', 'Address' => 'Damascus, Syria', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'rami2@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Rami Khalid', 'ar' => 'رامي خالد'], 'Specialization_id' => 9, 'Gender_id' => 1, 'Joining_Date' => '2024-02-01', 'Address' => 'Baghdad, Iraq', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'tariq1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Tariq Tariq', 'ar' => 'طارق طارق'], 'Specialization_id' => 10, 'Gender_id' => 1, 'Joining_Date' => '2024-03-01', 'Address' => 'Cairo, Egypt', 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'kareem1@example.com', 'password' => Hash::make('teacher1234'), 'Name' => ['en' => 'Kareem Kareem', 'ar' => 'كريم كريم'], 'Specialization_id' => 13, 'Gender_id' => 1, 'Joining_Date' => '2024-04-01', 'Address' => 'Alexandria, Egypt', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach($teachers as $teacher)
        {
            Teacher::create($teacher);
        }
    }
}

<?php

use App\Models\My_Parent;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my__parents')->delete();

        $parents = [
            ['email' => 'emadfather@gmail.com', 'name_en' => 'Emad', 'name_ar' => 'عماد محمد', 'phone' => '1234567810', 'job_en' => 'Programmer', 'job_ar' => 'مبرمج', 'address' => 'غزة، الرمال'],
            ['email' => 'ahmedfather@gmail.com', 'name_en' => 'Ahmed', 'name_ar' => 'أحمد علي', 'phone' => '1234567820', 'job_en' => 'Engineer', 'job_ar' => 'مهندس', 'address' => 'غزة، الشجاعية'],
            ['email' => 'khaledfather@gmail.com', 'name_en' => 'Khaled', 'name_ar' => 'خالد حسن', 'phone' => '1234567830', 'job_en' => 'Doctor', 'job_ar' => 'طبيب', 'address' => 'غزة، الزيتون'],
            ['email' => 'mohamedfather@gmail.com', 'name_en' => 'Mohamed', 'name_ar' => 'محمد سمير', 'phone' => '1234567840', 'job_en' => 'Teacher', 'job_ar' => 'مدرس', 'address' => 'غزة، التفاح'],
            ['email' => 'omarfather@gmail.com', 'name_en' => 'Omar', 'name_ar' => 'عمر سعيد', 'phone' => '1234567850', 'job_en' => 'Lawyer', 'job_ar' => 'محامي', 'address' => 'غزة، الجلاء'],
            ['email' => 'hassanfather@gmail.com', 'name_en' => 'Hassan', 'name_ar' => 'حسن مصطفى', 'phone' => '1234567860', 'job_en' => 'Accountant', 'job_ar' => 'محاسب', 'address' => 'غزة، النصر'],
            ['email' => 'youseffather@gmail.com', 'name_en' => 'Yousef', 'name_ar' => 'يوسف إبراهيم', 'phone' => '1234567870', 'job_en' => 'Architect', 'job_ar' => 'مهندس معماري', 'address' => 'غزة، الشيخ رضوان'],
            ['email' => 'mahmoudfather@gmail.com', 'name_en' => 'Mahmoud', 'name_ar' => 'محمود صالح', 'phone' => '1234567880', 'job_en' => 'Designer', 'job_ar' => 'مصمم', 'address' => 'غزة، الجندي المجهول'],
            ['email' => 'tariqfather@gmail.com', 'name_en' => 'Tariq', 'name_ar' => 'طارق زيدان', 'phone' => '1234567890', 'job_en' => 'Manager', 'job_ar' => 'مدير', 'address' => 'غزة، دوار أنصار'],
            ['email' => 'walidfather@gmail.com', 'name_en' => 'Walid', 'name_ar' => 'وليد حسن', 'phone' => '1234567800', 'job_en' => 'Analyst', 'job_ar' => 'محلل', 'address' => 'غزة، السرايا'],
            ['email' => 'saadfather@gmail.com', 'name_en' => 'Saad', 'name_ar' => 'سعد محمود', 'phone' => '1234567901', 'job_en' => 'Electrician', 'job_ar' => 'كهربائي', 'address' => 'غزة، الشيخ عجلين'],
            ['email' => 'ramzifather@gmail.com', 'name_en' => 'Ramzi', 'name_ar' => 'رمزي حسن', 'phone' => '1234567902', 'job_en' => 'Technician', 'job_ar' => 'فني', 'address' => 'غزة، تل الهوى'],
            ['email' => 'fadyfather@gmail.com', 'name_en' => 'Fady', 'name_ar' => 'فادي سمير', 'phone' => '1234567903', 'job_en' => 'Plumber', 'job_ar' => 'سباك', 'address' => 'غزة، شارع الوحدة'],
            ['email' => 'samirfather@gmail.com', 'name_en' => 'Samir', 'name_ar' => 'سمير عدنان', 'phone' => '1234567904', 'job_en' => 'Mechanic', 'job_ar' => 'ميكانيكي', 'address' => 'غزة، السوق الشعبي'],
            ['email' => 'hishamfather@gmail.com', 'name_en' => 'Hisham', 'name_ar' => 'هشام يوسف', 'phone' => '1234567905', 'job_en' => 'Carpenter', 'job_ar' => 'نجار', 'address' => 'غزة، شارع الثلاثيني'],
            ['email' => 'nassirfather@gmail.com', 'name_en' => 'Nassir', 'name_ar' => 'ناصر جمال', 'phone' => '1234567906', 'job_en' => 'Driver', 'job_ar' => 'سائق', 'address' => 'غزة، الزيتون'],
            ['email' => 'bilalfather@gmail.com', 'name_en' => 'Bilal', 'name_ar' => 'بلال علي', 'phone' => '1234567907', 'job_en' => 'Photographer', 'job_ar' => 'مصور', 'address' => 'غزة، الرمال'],
            ['email' => 'jamalfather@gmail.com', 'name_en' => 'Jamal', 'name_ar' => 'جمال خالد', 'phone' => '1234567908', 'job_en' => 'Painter', 'job_ar' => 'رسام', 'address' => 'غزة، الجلاء'],
            ['email' => 'rashidfather@gmail.com', 'name_en' => 'Rashid', 'name_ar' => 'راشد سمير', 'phone' => '1234567909', 'job_en' => 'Cook', 'job_ar' => 'طباخ', 'address' => 'غزة، الشيخ رضوان'],
            ['email' => 'aymanfather@gmail.com', 'name_en' => 'Ayman', 'name_ar' => 'أيمن زكريا', 'phone' => '1234567910', 'job_en' => 'Security Guard', 'job_ar' => 'حارس أمن', 'address' => 'غزة، السرايا'],
            ['email' => 'kamalfather@gmail.com', 'name_en' => 'Kamal', 'name_ar' => 'كمال زهير', 'phone' => '1234567911', 'job_en' => 'Dentist', 'job_ar' => 'طبيب أسنان', 'address' => 'غزة، الرمال'],
            ['email' => 'bahaa_father@gmail.com', 'name_en' => 'Bahaa', 'name_ar' => 'بهاء يوسف', 'phone' => '1234567912', 'job_en' => 'Chef', 'job_ar' => 'طاه', 'address' => 'غزة، الشيخ عجلين'],
            ['email' => 'nizarfather@gmail.com', 'name_en' => 'Nizar', 'name_ar' => 'نزار حسام', 'phone' => '1234567913', 'job_en' => 'Veterinarian', 'job_ar' => 'طبيب بيطري', 'address' => 'غزة، شارع الوحدة'],
            ['email' => 'tareqfather@gmail.com', 'name_en' => 'Tareq', 'name_ar' => 'طارق سمير', 'phone' => '1234567914', 'job_en' => 'IT Specialist', 'job_ar' => 'اخصائي تقنية معلومات', 'address' => 'غزة، السرايا'],
            ['email' => 'muhannadfather@gmail.com', 'name_en' => 'Muhannad', 'name_ar' => 'مهند خالد', 'phone' => '1234567915', 'job_en' => 'Electrician', 'job_ar' => 'كهربائي', 'address' => 'غزة، التفاح'],
            ['email' => 'ibrahimfather@gmail.com', 'name_en' => 'Ibrahim', 'name_ar' => 'إبراهيم محمود', 'phone' => '1234567916', 'job_en' => 'Librarian', 'job_ar' => 'أمين مكتبة', 'address' => 'غزة، الجلاء'],
            ['email' => 'zaki_father@gmail.com', 'name_en' => 'Zaki', 'name_ar' => 'زكي وليد', 'phone' => '1234567917', 'job_en' => 'Journalist', 'job_ar' => 'صحفي', 'address' => 'غزة، الشيخ رضوان'],
            ['email' => 'raedfather@gmail.com', 'name_en' => 'Raed', 'name_ar' => 'رائد سمير', 'phone' => '1234567918', 'job_en' => 'Civil Engineer', 'job_ar' => 'مهندس مدني', 'address' => 'غزة، دوار أنصار'],
            ['email' => 'samirfather2@gmail.com', 'name_en' => 'Samir', 'name_ar' => 'سمير عادل', 'phone' => '1234567919', 'job_en' => 'Banker', 'job_ar' => 'موظف بنك', 'address' => 'غزة، الجندي المجهول'],
            ['email' => 'faresfather@gmail.com', 'name_en' => 'Fares', 'name_ar' => 'فارس زكريا', 'phone' => '1234567920', 'job_en' => 'Pharmacist', 'job_ar' => 'صيدلي', 'address' => 'غزة، تل الهوى'],
        ];

        foreach ($parents as $parent) {
            $my_parent = new My_Parent();
            $my_parent->email = $parent['email'];
            $my_parent->password = Hash::make('parent1234');
            $my_parent->Name_Father = ['en' => $parent['name_en'], 'ar' => $parent['name_ar']];
            $my_parent->Phone_Father = $parent['phone'];
            $my_parent->Job_Father = ['en' => $parent['job_en'], 'ar' => $parent['job_ar']];
            $my_parent->Address_Father = $parent['address'];
            $my_parent->save();
        }
    }
}

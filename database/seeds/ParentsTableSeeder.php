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
            $my_parents = new My_Parent();
            $my_parents->email = 'parent@yahoo.com';
            $my_parents->password = Hash::make('12345678');
            $my_parents->Name_Father = ['en' => 'emad', 'ar' => 'عماد محمد'];
            $my_parents->Phone_Father = '1234567810';
            $my_parents->Job_Father = ['en' => 'programmer', 'ar' => 'مبرمج'];
            $my_parents->Address_Father ='القاهرة';
            $my_parents->save();

    }
}

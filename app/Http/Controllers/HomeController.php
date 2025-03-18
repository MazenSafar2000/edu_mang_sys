<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        return view('auth.student-parent-login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function about()
    {
        return view('auth.aboutus');
    }

    public function SchoolMangLogin()
    {
        return view('auth.schoolMangLogin');
    }


}

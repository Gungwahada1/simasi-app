<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absent; 
use App\Models\Student;
use App\Models\Subject; 
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $totalUsers = User::count(); 

        $totalAbsents = Absent::count(); 

        $totalStudents = Student::count(); 

        $totalSubjects = Subject::count(); 

        return view('dashboard', compact('totalUsers', 'totalAbsents', 'totalStudents',  'totalSubjects'));
    }
}

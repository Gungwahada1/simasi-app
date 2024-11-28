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
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user_id = Auth::user()->id;

        $totalUsers = User::count(); 
        $totalAbsents = Absent::where('user_id', $user_id)->count(); 
        $totalStudents = Student::count(); 
        $totalSubjects = Subject::count();
        
        $absent = Absent::select('absents.*', 'students.name as student_name', 'students.id as student_id', 'subjects.id as subject_id', 'subjects.subject_name')
        ->join('detail_subjects', 'absents.detail_subject_id', '=', 'detail_subjects.id')
        ->join('students', 'detail_subjects.student_id', '=', 'students.id')
        ->join('subjects', 'detail_subjects.subject_id', '=', 'subjects.id')
        ->where('absents.user_id', $user_id)
        ->where('absents.created_at', '>=', now()->subDay())
        ->whereNotNull('subject_start_datetime')
        ->first();

        return view('dashboard', compact('totalUsers', 'totalAbsents', 'totalStudents',  'totalSubjects', 'absent'));
    }
}

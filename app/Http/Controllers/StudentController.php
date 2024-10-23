<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
    
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('grade', 'like', '%' . $searchTerm . '%')
                  ->orWhere('gender', 'like', '%' . $searchTerm . '%');
        }
        
        $data = $query->paginate(5);

        return view('students.index', ['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    public function create(): View
    {
        return view('students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Fetch the authenticated user's UUID
        $id_user = Auth::user()->id; // Ensure this returns the correct UUID
    
        // Validate the request
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
            'gender' => 'required|in:M,F', // Validasi gender sesuai ENUM
        ]);
    
        // Prepare data for saving
        $input = $request->all();
        
        // Generate UUID for the student
        $input['id'] = (string) Str::uuid();
        $input['created_by'] = $id_user; // Assign UUID to created_by
        $input['updated_by'] = $id_user; // Assign UUID to updated_by
    
        // Save data to the database
        Student::create($input);
        
        return redirect()->route('students.index')
            ->with('success', 'Student created successfully');
    }
    

    public function show($id): View
    {
        $student = Student::findOrFail($id); // Ambil data student
        return view('students.show', compact('student'));
    }

    public function edit($id): View
    {
        $student = Student::findOrFail($id); // Ambil data student
        
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
            'gender' => 'required|in:M,F', // Validasi gender sesuai ENUM
        ]);

        $student = Student::findOrFail($id);
        $input = $request->all();
        
        // Update data student
        $student->update($input);

        return redirect()->route('students.index')
            ->with('warning', 'Student updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Student::findOrFail($id)->delete(); 
        return redirect()->route('students.index')
            ->with('danger', 'Student deleted successfully');
    }
}

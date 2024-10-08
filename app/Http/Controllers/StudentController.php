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
        $data = Student::paginate(5); // Menggunakan model Student langsung

        return view('students.index', ['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $id_user = Auth::user()->id;

        $request->validate([
            'name' => 'required',
            'grade' => 'required',
            'gender' => 'required|in:M,F', // Validasi gender sesuai ENUM
        ]);

        // Siapkan data untuk disimpan
        $input = $request->all();
        

        // Menghasilkan UUID
        // Menetapkan ID UUID
        $input['id'] = (string) Str::uuid();
        $input['created_by'] = $id_user ; 
        $input['updated_by'] = $id_user; 


        // Menyimpan data ke dalam database
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
            ->with('success', 'Student updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Student::findOrFail($id)->delete(); 
        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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

        $data = $query->paginate(10);

        return view('students.index', ['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        $subject = Subject::get();
        return view('students.create', compact('subject'));
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
        $input['created_by'] = $id_user; 
        $input['updated_by'] = $id_user;

        // Menyimpan data ke dalam database
        $student = Student::create($input);
        // Cek apakah ada subjects yang dipilih
        if (!empty($request->subject)) {
            foreach ($request->subject as $subjectId) {
                // Cari subject berdasarkan UUID
                $subject = Subject::where('id', $subjectId)->first();

                if ($subject) {
                    // Masukkan data langsung ke tabel detail_subjects
                    DB::table('detail_subjects')->insert([
                        'id' => (string) Str::uuid(),
                        'student_id' => $student->id,
                        'subject_id' => $subject->id
                    ]);
                }
            }
        }
        
        return redirect()->route('students.index')
            ->with('success', 'Student created successfully');
    }

    public function show($id): View
    {
        // Ambil data student
        $student = DB::table('students')->where('id', $id)->first();
        
        // Ambil data subjects yang terkait dengan student menggunakan query builder
        $subjects = DB::table('subjects')
            ->join('detail_subjects', 'subjects.id', '=', 'detail_subjects.subject_id')
            ->where('detail_subjects.student_id', $id)
            ->select('subjects.subject_name') // pilih kolom yang diperlukan
            ->get();

        return view('students.show', compact('student', 'subjects'));
    }

    public function edit($id): View
    {
        // Ambil data student
        $student = DB::table('students')->where('id', $id)->first();
        
        // Ambil semua subjects
        $subjects = DB::table('subjects')->get();
        
        // Ambil subjects yang sudah terhubung dengan student
        $selectedSubjects = DB::table('detail_subjects')
            ->where('student_id', $id)
            ->pluck('subject_id')
            ->toArray();

        // Kirim data ke view
        return view('students.edit', compact('student', 'subjects', 'selectedSubjects'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $id_user = Auth::user()->id;
        // Ambil data student berdasarkan ID
        $student = DB::table('students')->where('id', $id)->first();

        // Validasi input
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
            'gender' => 'required|in:M,F', // Validasi gender sesuai ENUM
        ]);

        // Periksa apakah ada perubahan pada 'name', 'grade', atau 'gender'
        $nameChanged = $student->name !== $request->name;
        $gradeChanged = $student->grade !== $request->grade;
        $genderChanged = $student->gender !== $request->gender;

        // Ambil subjects saat ini dari tabel pivot dan sort untuk perbandingan
        $currentSubjects = DB::table('detail_subjects')
            ->where('student_id', $id)
            ->pluck('subject_id')
            ->sort()
            ->values()
            ->toArray();

        // Subjects baru yang dipilih dari form, sort untuk perbandingan
        $newSubjects = collect($request->input('subjects', []))->sort()->values()->toArray();

        // Periksa apakah ada perubahan pada subjects
        $subjectsChanged = $currentSubjects !== $newSubjects;

        // Jika tidak ada perubahan, kembali ke halaman edit dengan pesan
        if (!$nameChanged && !$gradeChanged && !$genderChanged && !$subjectsChanged) {
            return redirect()->route('students.edit', $id)
                ->with('info', 'No changes were made to the student.');
        }

        // Update 'name', 'grade', dan 'gender' jika ada perubahan
        if ($nameChanged || $gradeChanged || $genderChanged) {
            DB::table('students')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'grade' => $request->grade,
                    'gender' => $request->gender,
                    'updated_by' => $id_user,
                ]);
        }

        // Sinkronisasi subjects di tabel pivot `detail_subjects` jika ada perubahan
        if ($subjectsChanged) {
            // Hapus subjects lama di tabel pivot
            DB::table('detail_subjects')->where('student_id', $id)->delete();

            // Tambahkan subjects baru yang dipilih
            $subjectData = array_map(function ($subjectId) use ($id) {
                return [
                    'id' => (string) Str::uuid(),
                    'student_id' => $id,
                    'subject_id' => $subjectId,
                ];
            }, $newSubjects);

            DB::table('detail_subjects')->insert($subjectData);
        }

        // Jika ada perubahan, kembali ke index dengan pesan sukses
        return redirect()->route('students.index')->with('warning', 'Student updated successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        Student::findOrFail($id)->delete(); 
        return redirect()->route('students.index')
            ->with('danger', 'Student deleted successfully');
    }
}

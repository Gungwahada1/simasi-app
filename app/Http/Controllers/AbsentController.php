<?php

namespace App\Http\Controllers;

use App\Models\DetailSubject;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Absent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AbsentController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:absent-list|absent-create|absent-edit|absent-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:absent-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:absent-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:absent-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $user_id = Auth::user()->id;
        $query = Absent::select('absents.*', 'students.name as student_name')
        ->join('detail_subjects', 'absents.detail_subject_id', '=', 'detail_subjects.id')
        ->join('students', 'detail_subjects.student_id', '=', 'students.id')
        ->where('absents.user_id', $user_id)
        ->orderBy('absents.created_at', 'desc');

        if ($request->filled('search')) {
            $searchTerm = $request->search;

            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('grade', 'like', '%' . $searchTerm . '%')
                ->orWhere('gender', 'like', '%' . $searchTerm . '%');
        }

        $data = $query->paginate(10);

        return view('absents.index', ['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $user_id = Auth::user()->id;
        $absent = Absent::get()
            ->where('user_id', $user_id)
            ->where('created_at', '>=', now()->subDay())
            ->first();

        if ($absent == null) {
            $students = Student::with('subjects')->get();
            $filteredSubjects = [];

            // Untuk setiap student, ambil subjects-nya
            foreach ($students as $student) {
                $filteredSubjects[$student->id] = $student->subjects; // Simpan subject yang terkait dengan student
            }

            return view('absents.create', [
                'students' => $students,
                'filteredSubjects' => $filteredSubjects
            ]);
        } else {
            return $this->edit($absent->id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)/*: RedirectResponse */
    {
        $user_id = Auth::user()->id;
        request()->validate([
            "student_id" => "required",
            "subject_id" => "required",
            "status" => "required",
            "subject_start_datetime" => "required",
            "subject_end_datetime" => "nullable",
            "proof_photo_start" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
            "proof_photo_end" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "location_start" => "required",
            "location_end" => "nullable",
            "daily_report" => "required",
            "daily_note" => "required",
        ]);


        $detail_subject_id = DetailSubject::where('student_id', $request->student_id)
            ->where('subject_id', $request->subject_id)
            ->first();

        $proofPhotoStartPath = $request->file('proof_photo_start')->store('proof_photos', 'public');
        $proofPhotoEndPath = $request->file('proof_photo_end')
            ? $request->file('proof_photo_end')->store('proof_photos', 'public')
            : null;

        Absent::create([
            'id' => Str::uuid()->toString(),
            'user_id' => $user_id,
            'detail_subject_id' => $detail_subject_id->id,
            'status' => request('status'),
            'subject_start_datetime' => request('subject_start_datetime') ?? '',
            'subject_end_datetime' => null,
            'proof_photo_start' => $proofPhotoStartPath,
            'proof_photo_end' => $proofPhotoEndPath,
            'location_start' => 'https://www.google.com/maps/search/?api=1&query=' . request('location_start'),
            'location_end' => null,
            'daily_report' => request('daily_report') ?? '',
            'daily_note' => request('daily_note') ?? '',
            'created_at' => Carbon::now(),
            'created_by' => $user_id,
            'updated_at' => null,
            'updated_by' => null,
            'deleted_at' => null,
            'deleted_by' => null,
        ]);

//        dd($detail_subject_id->id);

        return redirect()->route('dashboard')->with('success', 'Data saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Absent $absent
     * @return \Illuminate\Http\Response
     */
    public function show(Absent $absent): View
    {
        // return view('products.show',compact('absent'));
        return view('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Absent $absent
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        // Jika absensi awal sudah ada, siapkan data untuk mengedit absensi
        $absent = Absent::select('absents.*', 'students.name as student_name', 'students.id as student_id', 'subjects.id as subject_id', 'subjects.subject_name')
        ->join('detail_subjects', 'absents.detail_subject_id', '=', 'detail_subjects.id')
        ->join('students', 'detail_subjects.student_id', '=', 'students.id')
        ->join('subjects', 'detail_subjects.subject_id', '=', 'subjects.id')
        ->where('absents.id', $id)
        ->firstOrFail();

        $students = Student::all();
        $subjects = Subject::all();

        return view('absents.edit', compact('absent', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Absent $absent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absent $absent)/*: RedirectResponse*/
    {
        //  request()->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        // ]);

        // $absent->update($request->all());

        // return redirect()->route('absents.index')
        //                 ->with('success','Absent updated successfully');

        return view('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Absent $absent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absent $absent)/*: RedirectResponse*/
    {
        // $absent->delete();

        // return redirect()->route('products.index')
        //                 ->with('success','Product deleted successfully');
        return view('dashboard');
    }
}

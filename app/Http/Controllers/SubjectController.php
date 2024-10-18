<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SubjectController extends Controller
{
    public function index(Request $request): View
    {
        $data = DB::table('subjects')->paginate(5);

        return view('subjects.index', ['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('subjects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'subject_name' => 'required',
            'subject_description' => 'required',
        ]);

        Subject::create([
            'id' => Str::uuid()->toString(),
            'subject_name' => $request->subject_name,
            'subject_description' => $request->subject_description,
            'created_at' => Carbon::now(),
            'created_by' => null,
            'updated_at' => Carbon::now(),
            'updated_by' => null,
            'deleted_at' => null,
            'deleted_by' => null,
        ]);
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }

    public function show(Subject $subject): View
    {
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject): View
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $request->validate([
            'subject_name' => 'required',
            'subject_description' => 'required',
        ]);

        $subject->update([
            'subject_name' => $request->subject_name,
            'subject_description' => $request->subject_description,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('subjects.index')->with('warning', 'Subject updated successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        Subject::find($id)->delete();
        return redirect()->route('subjects.index')
            ->with('danger', 'Subject deleted successfully');
    }
}

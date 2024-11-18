<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SubjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = Subject::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
    
            $query->where('subject_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('subject_description', 'like', '%' . $searchTerm . '%');
        }
        $data = $query->paginate(5);

        return view('subjects.index', ['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('subjects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $id_user = Auth::user()->id;
        $request->validate([
            'subject_name' => 'required',
        ]);

        Subject::create([
            'id' => Str::uuid()->toString(),
            'subject_name' => $request->subject_name,
            'subject_description' => $request->subject_description ?? null,
            'created_at' => Carbon::now(),
            'created_by' => $id_user,
            'updated_at' => Carbon::now(),
            'updated_by' => $id_user,
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
        $id_user = Auth::user()->id;
        $request->validate([
            'subject_name' => 'required',
        ]);

        $input = $request->only(['subject_name', 'subject_description']);
        $input['subject_description'] = $request->subject_description ?? null;
        $changes = array_diff_assoc($input, $subject->only(['subject_name', 'subject_description']));

        if (empty($changes)) {
            return redirect()->route('subjects.edit', $subject->id)
                ->with('info', 'No changes were made to the subject.');
        }
        $subject->update(array_merge($input, ['updated_at' => Carbon::now(), 'updated_by' => $id_user]));
        return redirect()->route('subjects.index')->with('warning', 'Subject updated successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        Subject::find($id)->delete();
        return redirect()->route('subjects.index')
            ->with('danger', 'Subject deleted successfully');
    }
}

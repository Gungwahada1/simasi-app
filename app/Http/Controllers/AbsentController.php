<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absent;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
    public function index(): View
    {
        // $products = Product::latest()->paginate(5);

        // return view('products.index',compact('products'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        // return view('products.create');
        return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)/*: RedirectResponse */
    {
        // request()->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        // ]);

        // Product::create($request->all());

        // return redirect()->route('products.index')
        //                 ->with('success','Product created successfully.');
        //                 return view('dashboard');
                        return view('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absent  $absent
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
     * @param  \App\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function edit(Absent $absent): View
    {
        // return view('absents.edit',compact('absent'));
        return view('dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absent  $absent
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
     * @param  \App\Absent  $absent
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

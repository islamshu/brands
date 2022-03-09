<?php

namespace App\Http\Controllers;

use App\Models\HowItWork;
use Illuminate\Http\Request;

class HowItWorkController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-page'])->only('index');
        $this->middleware(['permission:delete-page'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = HowItWork::first();
        return view('dashboard.pages.how_works')->with('work',$works);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $work = HowItWork::first();
        $work->title_ar = $request->title_ar;
        $work->title_en = $request->title_en;
        $work->link = $request->link;
        $work->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HowItWork  $howItWork
     * @return \Illuminate\Http\Response
     */
    public function show(HowItWork $howItWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HowItWork  $howItWork
     * @return \Illuminate\Http\Response
     */
    public function edit(HowItWork $howItWork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HowItWork  $howItWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HowItWork $howItWork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HowItWork  $howItWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(HowItWork $howItWork)
    {
        //
    }
}

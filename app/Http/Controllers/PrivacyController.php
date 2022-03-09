<?php

namespace App\Http\Controllers;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
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
        return view('dashboard.pages.privacy')->with('privacy',Privacy::get());
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
        $page = new Privacy();
        $page->title_ar = $request->title_ar;
        $page->title_en = $request->title_en;
        $page->content_ar = $request->content_ar;
        $page->content_en = $request->content_en;
        $page->sort = $request->sort;
        $page->save();
        return redirect()->back()->with(['succss'=>trans('add succeefully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function show(Privacy $privacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Privacy $privacy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privacy $privacy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale,$id)
    {
       $about= Privacy::find($id);
       $about->delete();
       return response()->json(['icon' => 'success', 'title' => 'privicy deleted successfully'], 200);

    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\CodeImport;
use App\Models\Code;
use App\Models\CodePermfomed;
use App\Models\Performed;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Session;
class PerfomedController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-reference'])->only(['index','get_perfomed_vendor','get_perfomed_vendor_code','get_perfomed_vendor_code_status']);
        $this->middleware(['permission:create-reference'])->only('create');
    
  
    }//end of constructor
    //
    public function index(){
        if (Auth::user()->hasRole('Admin')) {
            $vendors = Vendor::get();
        }elseif (Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('read-reference')) {
            $vendors =  Vendor::where('enterprise_id',Auth::user()->ent_id)->get();
        }
        return view('dashboard.pefounds.index')->with('vendors',$vendors );
    }
    public function updateStatus(Request $request)
    {
        $user = CodePermfomed::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'Code status updated successfully.']);    }
    public function create(){
        return view('dashboard.pefounds.create');
    }
    public  function get_perfomed_vendor($locale,$id)
    {
        $vendor = Vendor::find($id);
        
        return view('dashboard.pefounds.indexforCode')->with('vendor',$vendor);

    }
    public function get_perfomed_vendor_code($locale,$id){
        $pe = Performed::where('peformed_id',$id)->get();
        return view('dashboard.pefounds.codes')->with('codes',$pe);
    }
    public function get_perfomed_vendor_code_status($locale,$id,$status){
        $pe = Performed::where('peformed_id',$id)->where('is_used',$status)->get();
        return view('dashboard.pefounds.codes')->with('codes',$pe);
    }
     public function store(Request $request)
    {
        $pero = new CodePermfomed();
        $pero->vendor_id = $request->vendor_id;
        $pero->total_codes = $request->total_codes;
        $pero->save();
        for($i= 0;$i < $pero->total_codes  ;$i++  ){
            $codesub = new Performed();
            $codesub->code = mt_rand(100000000,999999999);
            $codesub->peformed_id = $pero->id;
            $codesub->save();
        }
        return redirect()->back()->with(['success'=>trans('created successfully')]);
    }
    public  function destroy($locale,$id)
    {
        $preo = CodePermfomed::find($id);
        $preo->delete();
        return response()->json(['icon' => 'success', 'title' => 'Perfomec code deleted successfully'], 200);

       
    }
   
    public function Codeimport(Request $request)
    {

        Excel::import(new CodeImport($request->vendor_id), request()->file('file'));
        return back()->with(['success' => 'vendors Uploded successfully']);
    }
    public function download()
    {
        $file = public_path() . "/codes_new.xlsx";

        $headers = ['Content-Type: image/jpeg'];

        return \Response::download($file, 'brand.xlsx', $headers);
    }

    
}

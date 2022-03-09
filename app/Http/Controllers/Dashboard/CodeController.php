<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\GeneralCode;
use App\Exports\NotUsedCodeExport;
use App\Exports\UsedCodeExport;
use App\Http\Controllers\Controller;


use App\Models\Code;
use App\Models\CodeSubscription;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CodeController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-activition_code'])->only('index');
        $this->middleware(['permission:create-activition_code'])->only('create');
        $this->middleware(['permission:update-activition_code'])->only('edit');
        $this->middleware(['permission:delete-activition_code'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Code::get();
        return response()->view('dashboard.code.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subs = Subscription::where('type_paid', 'PREMIUM')->get();
        return response()->view('dashboard.code.create', compact('subs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'type' => 'required',
            'type_code' => 'required',
            'type_of_limit' => 'required',
            'price' => 'required',
            'value' => $request->type_of_limit == 'limit' ? 'required' : '',
            'start_time' => 'required',
            'start_time' => 'required'

        ]);
        if (!$validator->fails()) {
            $code = new Code();
            $code->name_ar = $request->name_ar;
            $code->name_en = $request->name_en;
            $code->type = $request->type;
            $code->sub_id = $request->sub_id;
            $code->price = $request->price;
            if ($code->type == 'single') {
                $code->number_of_code = 1;
                $code->total_remain = 1;
            } else {
                $code->number_of_code = $request->number_of_code;
                $code->total_remain = $request->number_of_code;
            }
            $code->type_of_limit = $request->type_of_limit;

            $code->start_at = $request->start_time;
            $code->end_at = $request->end_time;

            $code->value = $request->value;
            $code->sub_id = $request->sub_id;
            $code->save();
            if ($request->type_code == 'manual') {
                $codesub = new CodeSubscription();
                $codesub->code = $request->code;
                $codesub->sub_id = $request->sub_id;
                $codesub->save();
            } else {
                $code_num = $request->number_of_code;
                for ($i = 0; $i < $code_num; $i++) {
                    $codesub = new CodeSubscription();
                    $codesub->code = mt_rand(100000000, 999999999);
                    $codesub->sub_id = $request->sub_id;
                    $codesub->save();
                }
            }
            return response()->json(['icon' => 'success', 'title' => 'code created successfully'], $code ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    public function update_code(Request $request, $locale, $id)
    {

        $validator = Validator($request->all(), [

            'start_time' => 'required',
            'start_time' => 'required'

        ]);
        if (!$validator->fails()) {
            $code = Code::find($id);


            $code->start_at = $request->start_time;
            $code->end_at = $request->end_time;

            $code->save();

            return response()->json(['icon' => 'success', 'title' => 'code created successfully'], $code ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    public function updateStatus(Request $request)
    {

        $user = Code::find($request->id);
        $user->status = $request->status;
        $user->save();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show($locale,Code $code)
    {
      $codes=  CodeSubscription::where('sub_id',$code->sub_id)->get();

      $code_id = $code->sub_id;
   
      return view('dashboard.code.show_code',compact('codes','code_id'));
    }
    public function not_used_code($locale,$id)
    {
        $code = Code::find($id);
        $codes=  CodeSubscription::where('sub_id',$code->sub_id)->where('is_used',0)->get();
        $code_id = $code->sub_id;
        return view('dashboard.code.show_code',compact('codes','code_id'));
    }
    public function used_code($locale,$id)
    {
        $code = Code::find($id);
        $codes=  CodeSubscription::where('sub_id',$code->sub_id)->where('is_used',1)->get();
        $code_id = $code->sub_id;
        return view('dashboard.code.show_code',compact('codes','code_id'));
    }
    public function export_code($locale,$type_used,$sub_id)
    {
        if($type_used == 'used'){
            return Excel::download(new UsedCodeExport($sub_id), 'used_code.xlsx');
        }elseif($type_used == 'not'){
            return Excel::download(new NotUsedCodeExport($sub_id), 'not_used_code.xlsx');
        }elseif($type_used == 'all'){
            return Excel::download(new GeneralCode($sub_id), 'allcodes.xlsx');
 
        }
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {

        $subs = Subscription::where('type_paid', 'paid')->get();
        $code = Code::find($id);
        // dd($id);
        return response()->view('dashboard.code.edit', compact('subs', 'code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $offers = Code::where('id', $id)->first();
        $offers->delete();
        return response()->json(['icon' => 'success', 'title' => 'code deleted successfully'], 200);
    }
}

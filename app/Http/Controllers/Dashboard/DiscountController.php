<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\CodeSubscription;
use App\Models\Discount;
use App\Models\DiscountSubscription;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-discount'])->only('index');
        $this->middleware(['permission:create-discount'])->only('create');
        $this->middleware(['permission:update-discount'])->only('edit');
        $this->middleware(['permission:delete-discount'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Discount::get();
        return response()->view('dashboard.discount_code.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subs = Subscription::where('type_paid', 'PREMIUM')->get();
        return response()->view('dashboard.discount_code.create', compact('subs'));
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
            // 'type_code' => 'required',
            'type_of_limit' => 'required',
            'value' => $request->type_of_limit == 'limit' ? 'required' : '',
            'start_time' => 'required',
            'start_time' => 'required',
            'type_discount'=>'required',
            'value_discount'=>'required'

        ]);
        if (!$validator->fails()) {
            $code = new Discount();
            $code->name_ar = $request->name_ar;
            $code->name_en = $request->name_en;
            $code->type = $request->type;
            $code->sub_id = $request->sub_id;
            $code->type_discount = $request->type_discount;
            $code->value_discount = $request->value_discount;
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
                $codesub = new DiscountSubscription();
                $codesub->discount_id = $code->id;
                $codesub->code = $request->code;
                $codesub->sub_id = $request->sub_id;
                $codesub->save();
            } else {
                $code_num = $request->number_of_code;
                for ($i = 0; $i < $code_num; $i++) {
                    $codesub = new DiscountSubscription();
                    $codesub->code = mt_rand(100000000, 999999999);
                    $codesub->discount_id = $code->id;
                    $codesub->sub_id = $request->sub_id;
                    $codesub->save();
                }
            }
            return response()->json(['icon' => 'success', 'title' => 'code created successfully'], $code ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
    public function showCodes(Request $request)
    {
        $codes = DiscountSubscription::where('discount_id',$request->id)->get();
        return view('dashboard.discount_code.modal')->with('codes',$codes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $code = Discount::find($id);
        $subs = Subscription::where('type_paid', 'paid')->get();
        return response()->view('dashboard.discount_code.edit', compact('subs', 'code'));
    }
    public function updateStatus(Request $request)
    {

        $user = Discount::find($request->id);
        $user->status = $request->status;
        $user->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */

    public function update_code(Request $request, $locale, $id)
    {

        $validator = Validator($request->all(), [

            'start_time' => 'required',
            'start_time' => 'required'

        ]);
        if (!$validator->fails()) {
            $code = Discount::find($id);


            $code->start_at = $request->start_time;
            $code->end_at = $request->end_time;

            $code->save();

            return response()->json(['icon' => 'success', 'title' => 'code created successfully'], $code ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
    public function update(Request $request, $id)
    {

        $validator = Validator($request->all(), [

            'start_time' => 'required',
            'start_time' => 'required'

        ]);
        if (!$validator->fails()) {
            $code = Discount::find($id);


            $code->start_at = $request->start_time;
            $code->end_at = $request->end_time;

            $code->save();

            return response()->json(['icon' => 'success', 'title' => 'code created successfully'], $code ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
    }
}

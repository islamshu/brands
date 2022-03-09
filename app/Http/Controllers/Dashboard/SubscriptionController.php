<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use App\Models\Subscription;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-subscription'])->only('index','index_sub');
        $this->middleware(['permission:create-subscription'])->only(['create','create_paid_subsrcibe','create_trial_subsrcibe']);
        $this->middleware(['permission:update-subscription'])->only('updateStatus','edit');
        $this->middleware(['permission:delete-subscription'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // if(Auth::user()->hasRole('Admin')){
        
            $subs = Subscription::get();

        // }
        return response()->view('dashboard.subscripre.index',compact('subs'));

    }
    public function index_sub($locale,$value){
        if($value == 'paid'){
            $subs = Subscription::where('type_paid','PREMIUM')->get();
        }elseif($value == 'trial'){
            $subs = Subscription::where('type_paid','TRIAL')->get();
        } 
        return response()->view('dashboard.subscripre.index',compact('subs','value'));
           

    }
    public function updateStatus(Request $request)
    {
    
        $user = Subscription::find($request->id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'Subscription status updated successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enterprises = Enterprise::get();
        $brands= Vendor::whereNull('enterprise_id')->get();
        return view('dashboard.subscripre.create', compact('enterprises','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_paid_subsrcibe(){
        return view('dashboard.subscripre.create_paid');
    }
    public function create_trial_subsrcibe(){
        return view('dashboard.subscripre.create_trial');
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            'desc_ar' =>$request->type_paid == 'paid'?'required' : '',

            
            'desc_en' => $request->type_paid == 'paid'?'required' : '',
            'price'=>$request->type_paid == 'paid'?'required' : '',
            'balance' => $request->type_balance == 'Limit'?'required' : '' ,
            'expire_date_type' =>$request->type_paid == 'paid'?'required' : '',
            'image' => 'required',
            'add_members'=>$request->type_paid == 'paid'?'required' : '',
            'number_of_members'=>$request->add_members == 'active'?'required' : '',
            'number_of_dayes'=>$request->type_paid == 'paid'?'required' : '',
            'start_date' =>$request->type_paid == 'trial'?'required' : '',
            'start_date' =>$request->type_paid == 'trial'?'required' : '',
            'type_paid' => 'required',
            'sub_type'=>auth()->user()->hasRole('Admin') ? 'required' : '',
            'brands_id' =>$request->sub_type == 'Vendor' ? 'required' : '',
 
            'enterprises_id'=>$request->sub_type == 'Enterprise' ? 'required' : '',          
        ]);
        if (!$validator->fails()) {
            $request_all = $request->except('image');
         
            if ($request->image != null || $request->image != 'undefined') {
                       
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('images/subscribe', $imageName);
               $request_all['image'] = $imageName;
            }
            $request_all['enterprises_id'] = auth()->user()->ent_id;

                $sub=   Subscription::create($request_all);
            
            return response()->json(['icon' => 'success', 'title' => 'offer created successfully'], $sub ? 200 : 400);

         } else {
             dd($validator->getMessageBag());
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit($locale ,$id)
    {
        if(!auth()->user()->hasPermission('update-subscription')){
            abort(403);

        }
        $enterprises = Enterprise::get();
        $brands= Vendor::whereNull('enterprise_id')->get();
        $sub = Subscription::find($id);
        if($sub->type_paid == 'paid'){
            return view('dashboard.subscripre.edit_paid', compact('enterprises','brands','sub'));
        }else{
            return view('dashboard.subscripre.edit_trial', compact('enterprises','brands','sub'));
    
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update_subscription(Request $request, $locale,$id)
    {
        $sub = Subscription::find($id);
        
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            'desc_ar' =>$request->type_paid == 'paid'?'required' : '',
            'desc_en' => $request->type_paid == 'paid'?'required' : '',
            'price'=>$request->type_paid == 'paid'?'required' : '',
            'balance' => $request->type_balance == 'Limit'?'required' : '' ,
            'expire_date_type' =>$request->type_paid == 'paid'?'required' : '',
            'image' => 'required',
            'add_members'=>$request->type_paid == 'paid'?'required' : '',
            'number_of_members'=>$request->add_members == 'active'?'required' : '',
            'number_of_dayes'=>$request->type_paid == 'paid'?'required' : '',
            'start_date' =>$request->type_paid == 'trial'?'required' : '',
            'start_date' =>$request->type_paid == 'trial'?'required' : '',
            'sub_type'=>auth()->user()->hasRole('Admin') ? 'required' : '',
            'brands_id' =>$request->sub_type == 'Vendor' ? 'required' : '',
 
            'enterprises_id'=>$request->sub_type == 'Enterprise' ? 'required' : '',       
        ]);
        if (!$validator->fails()) {
            $request_all = $request->except('image');
        //  dd($request->image != 'undefined');
            if ($request->image != null && $request->image != 'undefined') {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('images/subscribe', $imageName);
               $request_all['image'] = $imageName;
            }
             
            if($request->sub_type == 'Enterprise' ){
                $request_all['enterprises_id'] = $request->enterprises_id;
                $request_all['brands_id'] = null;
            }
            if($request->sub_type == 'Vendor' ){
                $request_all['enterprises_id'] =  null;
                $request_all['brands_id'] =$request->brands_id;
            } 
            $request['enterprises_id'] = auth()->user()->ent_id;
            $sub->update($request_all);
            
            return response()->json(['icon' => 'success', 'title' => 'offer Updated successfully'], $sub ? 200 : 400);

         } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale,$id)    {
        $sub = Subscription::where('id', $id)->first();
        $sub->delete();
        if($sub->delete()){
            return response()->json(['icon' => 'success', 'title' => 'Subscription deleted successfully'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'error when delete'], 400);
        }
    }
}

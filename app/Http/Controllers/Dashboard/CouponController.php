<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Coupon;
use App\Models\CouponTime;
use App\Models\Enterprise;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-promocode'])->only('index','vednor_promocode');
        $this->middleware(['permission:create-promocode'])->only('create_coupon');
        $this->middleware(['permission:update-promocode'])->only('edit');
        $this->middleware(['permission:delete-promocode'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(auth()->user()->hasRole('Admin')){
        //     $coupons= Coupon::get();
        // }elseif(auth()->user()->hasRole('Enterprises')){
        //     $coupons = Coupon::where('enterprise_id',auth()->user()->ent_id)->get();
        // }
        // elseif(auth()->user()->hasRole('Vendors')){
        //     $coupons = Coupon::where('vendor_id',auth()->user()->vendor_id)->get();
        // }
        // return view('dashboard.coupon.index', compact('coupons'));
        $vendors = Vendor::where('enterprise_id', Auth::user()->ent_id)->get();
        return view('dashboard.coupon.vendores', compact('vendors'));


    }
    public function vednor_promocode($locale,$id)
    {
        $coupons = Coupon::where('vendor_id',$id)->get();
        $vendor = Vendor::find($id);
        return view('dashboard.coupon.index', compact('coupons','vendor'));
    }
    public function updateStatus(Request $request)
    {
    
        $user = Coupon::find($request->id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'coupoun status updated successfully.']);
    }
    public function create_coupon($locale,$id)
    {
        $vendor = Vendor::find($id);
        // $brands = Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
        return view('dashboard.coupon.create', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('Admin')){
            $enterprises = Enterprise::get();
            $brands = Vendor::where('enterprise_id',null)->get();

            return view('dashboard.coupon.create', compact('brands','enterprises'));

        }elseif(auth()->user()->hasRole('Enterprises')){
            $brands = Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
            return view('dashboard.coupon.create', compact('brands'));

        }
        elseif(auth()->user()->hasRole('Vendors')){
            return view('dashboard.coupon.create');

        }
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
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            // 'tearm_ar' => 'required',
            // 'tearm_en' => 'required',
            'model_type'=>auth()->user()->hasRole('Admin') ? 'required' : '',
            'enterprise_id'=>'required_if:model_type,==,enterprice',
            'type'=>'required',
            'value'=>'required',
            'start_at'=>'required',
            'end_at'=>'required',
            'special_days'=>'required',
            'days'=>'required_if:special_days,==,active',
            'special_time'=>'required',
            'image' => 'required',
            'member_type' => 'required',
            'promocode' => 'required',
            'from_0'=>'required_if:special_time,==,active',
            'from_1'=>'required_if:special_time,==,active',
            'from_2'=>'required_if:special_time,==,active',
            'from_3'=>'required_if:special_time,==,active',
            'from_4'=>'required_if:special_time,==,active',
            'from_5'=>'required_if:special_time,==,active',
            'from_6'=>'required_if:special_time,==,active',
            'to_0'=>'required_if:special_time,==,active',
            'to_1'=>'required_if:special_time,==,active',
            'to_2'=>'required_if:special_time,==,active',
            'to_3'=>'required_if:special_time,==,active',
            'to_4'=>'required_if:special_time,==,active',
            'to_5'=>'required_if:special_time,==,active',
            'to_6'=>'required_if:special_time,==,active',
        ]);
        if (!$validator->fails()) {
            $request_all = $request->except('from_0','from_1','from_2','from_3','from_4','from_5','from_6','store_link',
            'to_0','to_1','to_2','to_3','to_4','to_5','to_6','enterprise_id');
            
            if(auth()->user()->hasRole('Admin')){
                $request_all['enterprise_id'] = $request->enterprise_id;
                $request['vendor_id']= $request->vendor_id;
            }
            if(auth()->user()->hasRole('Enterprises')){
                $request_all['enterprise_id'] = auth()->user()->ent_id;
                $request['vendor_id']= $request->vendor_id;
            }
            if(auth()->user()->hasRole('Vendors')){
                $request['vendor_id']=auth()->user()->vendor_id;
            }
            $file = $request->file('image');
            
            $imageName = time() . 'image.' . $file->getClientOriginalExtension();
            $file->move('images/coupun', $imageName);
            $request_all['image'] = $imageName;
            
            $coupon= Coupon::create($request_all);
            if($request->special_time == 'active'){
                $time = new CouponTime();
                $time->from_0 = $request->from_0;
                $time->from_1 = $request->from_1;
                $time->from_2 = $request->from_2;
                $time->from_3 = $request->from_3;
                $time->from_4 = $request->from_4;
                $time->from_5 = $request->from_5;
                $time->from_6 = $request->from_6;
                $time->to_0 = $request->to_0;
                $time->to_1 = $request->to_1;
                $time->to_2 = $request->to_2;
                $time->to_3 = $request->to_3;
                $time->to_4 = $request->to_4;
                $time->to_5 = $request->to_5;
                $time->to_6 = $request->to_6;
                $time->coupon_id = $coupon->id;
                $time->save();
            }
            return response()->json(['icon' => 'success', 'title' => 'Coupon created successfully']);
        
    } else {
       
        return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
    }

  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($local, $id)
    {
        $coupun = Coupon::find($id);
  
        if(auth()->user()->hasRole('Admin')){
            $enterprises = Enterprise::get();
            $brands = Vendor::where('enterprise_id',null)->get();

            return view('dashboard.coupon.edit', compact('brands','enterprises','coupun'));

        }elseif(auth()->user()->hasRole('Enterprises')){
            $brands = Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
            return view('dashboard.coupon.edit', compact('brands','coupun'));

        }
        elseif(auth()->user()->hasRole('Vendors')){
            return view('dashboard.coupon.edit', compact('coupun'));

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update_coupun(Request $request,$local, $id)
    {
       $coupon =  Coupon::find($id);
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            // 'tearm_ar' => 'required',
            // 'tearm_en' => 'required',
            'model_type'=>auth()->user()->hasRole('Admin') ? 'required' : '',
            'enterprise_id'=>'required_if:model_type,==,enterprice',
            'type'=>'required',
            'value'=>'required',
            'start_at'=>'required',
            'end_at'=>'required',
            'member_type'=>'required',
            'promocode'=>'required',
            'special_days'=>'required',
            'days'=>'required_if:special_days,==,active',
            'special_time'=>'required',
            'image' => 'required',
            'from_0'=>'required_if:special_time,==,active',
            'from_1'=>'required_if:special_time,==,active',
            'from_2'=>'required_if:special_time,==,active',
            'from_3'=>'required_if:special_time,==,active',
            'from_4'=>'required_if:special_time,==,active',
            'from_5'=>'required_if:special_time,==,active',
            'from_6'=>'required_if:special_time,==,active',
            'to_0'=>'required_if:special_time,==,active',
            'to_1'=>'required_if:special_time,==,active',
            'to_2'=>'required_if:special_time,==,active',
            'to_3'=>'required_if:special_time,==,active',
            'to_4'=>'required_if:special_time,==,active',
            'to_5'=>'required_if:special_time,==,active',
            'to_6'=>'required_if:special_time,==,active',
        ]);
        if (!$validator->fails()) {
            $request_all = $request->except('from_0','from_1','from_2','from_3','from_4','from_5','from_6',
            'to_0','to_1','to_2','to_3','to_4','to_5','to_6','enterprise_id');
            
            if(auth()->user()->hasRole('Admin')){
                $request_all['enterprise_id'] = $request->enterprise_id;
                $request['vendor_id']= $request->vendor_id;

            }
            if(auth()->user()->hasRole('Enterprises')){
                $request_all['enterprise_id'] = auth()->user()->ent_id;
                $request['vendor_id']= $request->vendor_id;
            }
            if(auth()->user()->hasRole('Vendors')){
                $request['vendor_id']=auth()->user()->vendor_id;
            }
            $file = $request->file('image');
            if ($request->image != null && $request->image != 'undefined') {
            
            $imageName = time() . 'image.' . $file->getClientOriginalExtension();
            $file->move('images/coupun', $imageName);
            $request_all['image'] = $imageName;
            }
        // 4   dd($request_all);
           $coupon->update($request_all);
            if($request->special_time == 'active'){
                $time = CouponTime::firstOrCreate([
                    'id' => $coupon->id
                ],[
                    'from_0'=>$request->from_0,
                    'from_1'=>$request->from_1,
                    'from_2'=>$request->from_2,
                    'from_3'=>$request->from_3,
                    'from_4'=>$request->from_4,
                    'from_5'=>$request->from_5,
                    'from_6'=>$request->from_6,
                    'to_0'=>$request->to_0,
                    'to_1'=>$request->to_1,
                    'to_2'=>$request->to_2,
                    'to_3'=>$request->to_3,
                    'to_4'=>$request->to_4,
                    'to_5'=>$request->to_5,
                    'to_6'=>$request->to_6,
                    'coupon_id'=>$coupon->id,
                ]);
             
            }
            return response()->json(['icon' => 'success', 'title' => 'Coupon created successfully']);
        
    } else {
        dd($validator->getMessageBag());
        return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $Coupon = Coupon::find($id);
        $Coupon->delete();
        if ($Coupon->delete()) {
            return response()->json(['icon' => 'success', 'title' => 'Coupon deleted successfully'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'Coupon when delete'], 400);
        }
    }
}

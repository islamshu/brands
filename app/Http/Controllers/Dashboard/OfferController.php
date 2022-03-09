<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\OfferImport;
use App\Models\Enterprise;
use App\Models\Offerdays;
use App\Models\Offerimage;
use App\Models\Offertype;
use App\Models\Vendor;
use Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OfferController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-offer'])->only('index','offers');
        $this->middleware(['permission:create-offer'])->only('create_offer');
        $this->middleware(['permission:update-offer'])->only('edit');
        $this->middleware(['permission:delete-offer'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function offers($locale , $id)
     {
         $vendor = Vendor::find($id);
         $offers = Offer::where('vendor_id',$id)->get();
         
         return response()->view('dashboard.offers.offerIndex', compact('offers','vendor'));
        }
    public function index()
    {


        if (Auth::user()->hasRole('Admin')) {
            $vendors = Vendor::get();
            
        } elseif (Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('read-offer')) {
            $vendors = Vendor::where('enterprise_id', Auth::user()->ent_id)->get();

            // $offers = Offer::where('enterprises_id', auth()->user()->ent_id)->get();
        } elseif (Auth::user()->hasRole('Vendors')) {
           
            $id = Auth::user()->vendor_id;
            $vendor = Vendor::find($id);
            return response()->view('dashboard.offers.create', compact('vendor'));;

        }

        return response()->view('dashboard.offers.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $id = null)
    {
        $vendor = Vendor::find($id);
        if (Auth::user()->hasRole('Admin')) {
            $enterprise = Enterprise::get();
            $brands = Vendor::whereNotNull('enterprise_id')->get();
            return response()->view('dashboard.offers.create', compact('enterprise', 'brands'));
        } elseif (Auth::user()->hasRole('Enterprises')) {
            $brands = Vendor::where('enterprise_id', auth()->user()->ent_id)->get();
            // dd($brands);
            return response()->view('dashboard.offers.create', compact('brands'));
        } elseif (Auth::user()->hasRole('Vendors')) {
            // $brands = Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
            // dd($brands);
            return response()->view('dashboard.offers.create');
        }
    }
    public function create_offer($locale, $id)
    {
        $vendor = Vendor::find($id);
        if (Auth::user()->hasRole('Admin')) {
            $enterprise = Enterprise::get();
            $brands = Vendor::whereNotNull('enterprise_id')->get();
            return response()->view('dashboard.offers.create', compact('enterprise', 'brands','vendor'));
        } elseif (Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('create-offer') ) {
            $brands = Vendor::where('enterprise_id', auth()->user()->ent_id)->get();
            // dd($brands);
            return response()->view('dashboard.offers.create', compact('brands','vendor'));
        } elseif (Auth::user()->hasRole('Vendors')) {
            // $brands = Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
            // dd($brands);
            return response()->view('dashboard.offers.create', compact('vendor'));;
        }
    }

    public function get_brands(Request $request)
    {
        if ($request->enteprice_id == null) {
            $brands = Vendor::where('enterprise_id', null)->get();
        } else {
            $brands = Vendor::where('enterprise_id', $request->enteprice_id)->get();
        }
        return response()->json($brands);
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
            // 'enterprises_id' => 'required',
            // 'brand_id' => 'required',
            'member_type' => 'required',
            'usege_member' => 'required',
            'usage_member_number' => $request->usege_member == 'limit' ? 'required' : '',
            'usege_system' => 'required',
            'usage_number_system' =>$request->usege_system == 'limit' ? 'required' : '',
            'datetime_use' => 'required',
            'datatime_use_type' => 'required',
            // <option value="" selected disabled>
            // 'points' => 'required',
            // 'exchange_points' => 'required',
            // 'exchange_points_number' => 'required',
            'exchange_cash' => 'required',
            // 'exchange_cash_number' => 'required',
            'payment_type' => 'required',
            'sort' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'offer_type' => auth()->user()->hasRole('Admin') ? 'required' : '',
            'desc_en' => 'required',
            'desc_ar' => 'required',
            'start_time' => 'required',
            // 'terms_ar' => 'required',
            // 'terms_en' => 'required'
        ]);
        if (!$validator->fails()) {


            $request_alll = ['enterprises_id',
            'primary_image',
            'image',
            'price_after_discount',
            'price_befor_discount',
            'discount_value',
            'from_0',
            'from_1',
            'from_2',
            'from_3',
            'from_4',
            'from_5',
            'from_6',
            'to_0',
            'to_1',
            'to_2',
            'to_3',
            'to_4',
            'to_5',
            'to_6',
            'specific_days',
      
            'TotalImages',
        'offer_type_2'];
            for ($x = 0; $x < $request->TotalImages; $x++) 
            {
                array_push($request_alll,'image'.$x);
  
               
            }

            $request_all = $request->except($request_alll);


            if (auth()->user()->hasRole('Admin')) {
                $request_all['enterprises_id'] =  $request->enterprises_id;
            }
            if (auth()->user()->hasRole('Enterprises')) {
                $request_all['enterprises_id'] =  auth()->user()->ent_id;
                $request_all['offer_type'] =  'brand';
            }

            if (auth()->user()->hasRole('Vendors')) {
                $brand_id = auth()->user()->vendor_id;
                $request_all['offer_type'] =  'brand';
                // $request_all['vendor_id'] = $brand_id;
            }
            $offer =   Offer::create($request_all);

            $image_offer =  new Offerimage();
            $image_offer->offer_id = $offer->id;
            $file = $request->file('primary_image');
            $imageName = time() . 'image.' . $file->getClientOriginalExtension();
            $file->move('images/primary_offer', $imageName);
            $image_offer->primary_image = $imageName;
            if ($request->TotalImages > 0) {
                $files = [];
                for ($x = 0; $x < $request->TotalImages; $x++) {

                    if ($request->hasFile('image' . $x)) {
                        $imagex      = $request->file('image' . $x);

                        $imageNamee = time() . 'image.' . $imagex->getClientOriginalExtension();
                        $imagex->move('images/primary_offer', $imageNamee);
                       
                        // $files[$x] = $imageNamee;
                        array_push($files,$imageNamee);
                    }
                }
                $image_offer->image = json_encode($files);
            }
                $image_offer->save();
                $offer_type = new Offertype();

                $offer_type->offer_id = $offer->id;
                $offer_type->offer_type = $request->offer_type_2;
                $offer_type->price = $request->price;

                if($request->offer_type_2 == 'buyOneGetOne'){
                    $offer_type->sale = $request->price;
                    
                }elseif($request->offer_type_2 == 'special_discount'){
                    $offer_type->sale = $request->price_befor_discount - $request->price;
                }elseif($request->offer_type_2 == 'general_offer'){
                    $offer_type->discount_value = $request->discount_value;
                    $offer_type->discount_type = $request->discount_type;

                }
                // $offer_type->price_after_discount = $request->price_after_discount;
                // $offer_type->price_befor_discount = $request->price_befor_discount;
                // $offer_type->discount_value = $request->discount_value;
                $offer_type->save();
                if($request->specific_days == 'actvie'){
                    $offer_days = new Offerdays();
                    $offer_days->offer_id = $offer->id;
                    $offer_days->to_0 = $request->to_0;
                    $offer_days->to_1 = $request->to_1;
                    $offer_days->to_2 = $request->to_2;
                    $offer_days->to_3 = $request->to_3;
                    $offer_days->to_4 = $request->to_4;
                    $offer_days->to_5 = $request->to_5;
                    $offer_days->to_6 = $request->to_6;
                    $offer_days->from_0 = $request->from_0;
                    $offer_days->from_1 = $request->from_1;
                    $offer_days->from_2 = $request->from_2;
                    $offer_days->from_3 = $request->from_3;
                    $offer_days->from_4 = $request->from_4;
                    $offer_days->from_5 = $request->from_5;
                    $offer_days->from_6 = $request->from_6;
                    $offer_days->save();
                    
                }
               
           




            return response()->json(['icon' => 'success', 'title' => 'offer created successfully'], $offer ? 200 : 400);
        } else {
            // dd($validator->getMessageBag());
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }
    public function update_status(Request $request)
    {
        $user = Offer::find($request->offer_id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'Offer status updated successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        if (auth()->user()->hasRole('Admin')) {
            $enterprise = Enterprise::get();
            $brands = Vendor::whereNotNull('enterprise_id')->get();
            $offer = Offer::find($id);
            return response()->view('dashboard.offers.edit', compact('enterprise', 'brands', 'offer'));
        }
        if (auth()->user()->hasRole('Enterprises') || auth()->user()->hasPermission('update-offer') ) {
            $brands = Vendor::where('enterprise_id', auth()->user()->ent_id)->get();
            $offer = Offer::find($id);
            return response()->view('dashboard.offers.edit', compact('brands', 'offer'));
        }
        if (Auth::user()->hasRole('Vendors')) {
            $offer = Offer::find($id);
            return response()->view('dashboard.offers.edit', compact('offer'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update_offer(Request $request, $locale, $id)
    {
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            // 'enterprises_id' => 'required',
            // 'brand_id' => 'required',
            'member_type' => 'required',
            'usege_member' => 'required',
            'usage_member_number' => $request->usege_member == 'limit' ? 'required' : '',
            'usege_system' => 'required',
            'usage_number_system' => $request->usege_system == 'limit' ? 'required' : '',
            'datetime_use' => 'required',
            'datatime_use_type' => 'required',
            // <option value="" selected disabled>
            // 'points' => 'required',
            // 'exchange_points' => 'required',
            // 'exchange_points_number' => 'required',
            'exchange_cash' => 'required',
            // 'exchange_cash_number' => 'required',
            'payment_type' => 'required',
            'sort' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'offer_type' => auth()->user()->hasRole('Admin') ? 'required' : '',
            'desc_en' => 'required',
            'desc_ar' => 'required',
            'start_time' => 'required',
            // 'terms_ar' => 'required',
            // 'terms_en' => 'required'
        ]);
        if (!$validator->fails()) {


            $request_alll = ['enterprises_id',
            'primary_image',
            'image',
            'price_after_discount',
            'price_befor_discount',
            'discount_value',
            'from_0',
            'from_1',
            'from_2',
            'from_3',
            'from_4',
            'from_5',
            'from_6',
            'to_0',
            'to_1',
            'to_2',
            'to_3',
            'to_4',
            'to_5',
            'to_6',
            'specific_days',
      
            'TotalImages',
        'offer_type_2'];
        $offer = Offer::find($id);
        if($request->TotalImages > 0){
            for ($x = 0; $x < $request->TotalImages; $x++) 
            {
                array_push($request_alll,'image'.$x);
  
               
            }
        }
            

            $request_all = $request->except($request_alll);


            if (auth()->user()->hasRole('Admin')) {
                $request_all['enterprises_id'] =  $request->enterprises_id;
            }
            if (auth()->user()->hasRole('Enterprises')) {
                $request_all['enterprises_id'] =  auth()->user()->ent_id;
                $request_all['offer_type'] =  'brand';
            }

            if (auth()->user()->hasRole('Vendors')) {
                $brand_id = auth()->user()->vendor_id;
                $request_all['offer_type'] =  'brand';
                // $request_all['vendor_id'] = $brand_id;
            }
            $offer->update($request_all);

            $image_offer =  $offer->offerimage;
            
            if($request->primary_image != 'undefined' &&  $request->primary_image != null){

           
            $file = $request->file('primary_image');
            $imageName = time() . 'image.' . $file->getClientOriginalExtension();
            $file->move('images/primary_offer', $imageName);
            $image_offer->primary_image = $imageName;
            }
            if ($request->TotalImages > 0) {
                $files = [];
                for ($x = 0; $x < $request->TotalImages; $x++) {

                    if ($request->hasFile('image' . $x)) {
                        $imagex      = $request->file('image' . $x);

                        $imageNamee = time() . 'image.' . $imagex->getClientOriginalExtension();
                        $imagex->move('images/primary_offer', $imageNamee);
                       
                        // $files[$x] = $imageNamee;
                        array_push($files,$imageNamee);
                    }
                }
                $image_offer->image = json_encode($files);
            }
                $image_offer->save();
                $offer_type = $offer->offertype;

                $offer_type->offer_type = $request->offer_type_2;
                $offer_type->price = $request->price;

                if($request->offer_type_2 == 'buyOneGetOne'){
                    $offer_type->sale = $request->price;
                    
                }elseif($request->offer_type_2 == 'special_discount'){
                    $offer_type->sale = $request->price_befor_discount - $request->price;
                }elseif($request->offer_type_2 == 'general_offer'){
                    $offer_type->discount_value = $request->discount_value;
                    $offer_type->discount_type = $request->discount_type;

                }
                // $offer_type->price_after_discount = $request->price_after_discount;
                // $offer_type->price_befor_discount = $request->price_befor_discount;
                // $offer_type->discount_value = $request->discount_value;
                $offer_type->save();
                if($request->specific_days == 'actvie'){
                    $offer_days = $offer->offerday;
                    $offer_days->to_0 = $request->to_0;
                    $offer_days->to_1 = $request->to_1;
                    $offer_days->to_2 = $request->to_2;
                    $offer_days->to_3 = $request->to_3;
                    $offer_days->to_4 = $request->to_4;
                    $offer_days->to_5 = $request->to_5;
                    $offer_days->to_6 = $request->to_6;
                    $offer_days->from_0 = $request->from_0;
                    $offer_days->from_1 = $request->from_1;
                    $offer_days->from_2 = $request->from_2;
                    $offer_days->from_3 = $request->from_3;
                    $offer_days->from_4 = $request->from_4;
                    $offer_days->from_5 = $request->from_5;
                    $offer_days->from_6 = $request->from_6;
                    $offer_days->save();
                    
                }
               
           




            return response()->json(['icon' => 'success', 'title' => 'offer updated successfully'], $offer ? 200 : 400);
        } else {
            // dd($validator->getMessageBag());
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $offers = Offer::where('id', $id)->first();
        $offers->delete();
        if ($offers->delete()) {
            return response()->json(['icon' => 'success', 'title' => 'offer deleted successfully'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'error when delete'], 400);
        }
    }
    public function import(Request $request, $locale,$id)
    {
     
        $vendor = Vendor::find($id);
        
        // Session::put('vendor_id', $id);
        // dd($request);
        Excel::import(new OfferImport($id), request()->file('file'));
        return redirect()->back()->with(['success' => 'Branch Uploded successfully']);
    }
    public function get_modal(Request $request){
        $vendor = Vendor::find($request->id);
        // dd($vendor);
        return view('dashboard.offers.modal')->with('vendor',$vendor);
    }
}

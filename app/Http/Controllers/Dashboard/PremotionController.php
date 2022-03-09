<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Branch;
use App\Models\City;
use App\Models\Enterprise;
use App\Models\enterprise_city;
use App\Models\enterprise_country;
use App\Models\Homeslider;
use App\Models\HomesliderOffer;
use App\Models\Offer;
use App\Models\Popup;
use App\Models\Slider;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PremotionController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-promotion'])->only('offer_slider','index','get_country_promotion','get_city_for_country','get_elemet_by_type');
        $this->middleware(['permission:create-promotion'])->only('create_item','create_offer');
        $this->middleware(['permission:update-promotion'])->only('edit');
        $this->middleware(['permission:delete-promotion'])->only('homeslider_delete');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //   $countries =   enterprise_country::with('country')->where('enterprise_id',Auth::user()->ent_id)->get();
        return view('dashboard.promo.index');
    }
    public function get_country_promotion($locale, $type)
    {
     
        $countries =   enterprise_country::with('country')->where('enterprise_id', Auth::user()->ent_id)->get();


        return view('dashboard.promo.country', compact('countries', 'type'));
    }
    public function get_city_for_country($locale, $type, $id)
    {
        $city = enterprise_city::with('city')->whereHas('city', function ($q) use ($id) {
            $q->where('country_id', $id);
        })->where('enterprise_id', Auth::user()->ent_id)->get();

        return view('dashboard.promo.city', compact('city', 'type'));
    }
    public function get_elemet_by_type($locale,$type,$city_id){
        if($type == 'slider'){
            $premotions = Slider::where('city_id',$city_id)->get();
            return view('dashboard.promo.sliders', compact('premotions', 'type','city_id'));
        }
        if($type == 'popup'){
            $premotions = Popup::where('city_id',$city_id)->get();
            return view('dashboard.promo.popups', compact('premotions', 'type','city_id'));
        }
        if($type == 'homeslider'){
            $premotions = Homeslider::where('city_id',$city_id)->get();
            return view('dashboard.promo.homeslider', compact('premotions', 'type','city_id'));
        }
        if($type == 'banner'){
            $premotions = Banner::where('city_id',$city_id)->get();
            return view('dashboard.promo.banner', compact('premotions', 'type','city_id'));
        }
       

    }
    public function change_color(Request $request, $locale){
        $premotions = Homeslider::find($request->id);
        $premotions->color = $request->color;
        $premotions->save();
        return true;

    }
    public function homeslider_delete($locale ,$id){
        $premotions = HomesliderOffer::where('id',$id)->first();
        $offer = Offer::find($premotions->offer_id);
        $offer->is_slider = 0;
        $offer->save();
        $premotions->delete();
        return response()->json(['icon' => 'success', 'title' => 'homeslider deleted successfully'], 200);

    }
    public function create_item($locale, $type, $city_id)
    {
        $categorys = Enterprise::find(auth()->user()->ent_id)->categorys;
        $brands =   Vendor::where('enterprise_id',auth()->user()->ent_id)->get();
        $branchs = Branch::whereHas('vendor', function ($q)  {
            $q->where('enterprise_id',auth()->user()->ent_id);
        })->get();
       if($type == 'slider'){
        return view('dashboard.promo.create_slider', compact('city_id','categorys','brands','branchs'));
       }
       if($type == 'popup'){
        return view('dashboard.promo.create_popup', compact('city_id','categorys','brands','branchs'));
       }
       if($type == 'homeslider'){
        return view('dashboard.promo.create_homeslider', compact('city_id'));
       }
       if($type == 'banner'){
        $homeslider = Homeslider::where('city_id',$city_id)->get();

        return view('dashboard.promo.create_banner', compact('city_id','homeslider'));
       }
    }
    public function store_item(Request $request, $locale, $type, $city_id)
    {
        $city = City::find($city_id);
        if($type == 'slider'){
            $slider = new Slider();
            $image =$request->image;
            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
            $image->move('images/slider', $imageName);
            $slider->image = $imageName;
            $slider->city_id = $city_id;
            $slider->country_id  = $city->country_id ;
            $slider->vendor_id   = $request->vendor_id;
            $slider->branch_id    = $request->branch_id ;
            $slider->categoty_id    = $request->categoty_id ;
            $slider->show_as    = $request->show_as ;
            $slider->type    = $request->type ;
            $slider->link    = $request->link ;
            $slider->start_date = $request->start_date;
            $slider->end_date = $request->end_date;
            $slider->save();
            return response()->json(['icon' => 'success', 'title' => 'Slider  created successfully'], 200);
        }elseif($type == 'popup'){
            $popup = new Popup();
            if($request->image != null && $request->image != 'undefined'){

           
            $image =$request->image;
            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
            $image->move('images/popup', $imageName);
            $popup->image = $imageName;
        }
            $popup->type_show= $request->type_show;
            $popup->text = $request->text;
            $popup->city_id = $city_id;
            $popup->country_id  = $city->country_id ;
            $popup->vendor_id   = $request->vendor_id;
            $popup->categoty_id    = $request->categoty_id ;
            $popup->show_as    = $request->show_as ;
            $popup->show_for    = $request->show_for ;
            $popup->start_date = $request->start_date;
            $popup->end_date = $request->end_date;
            $popup->number_of_hour = $request->number_of_hour;
            $popup->save();
            return response()->json(['icon' => 'success', 'title' => 'Popup  created successfully'], 200);  
        }elseif($type == 'homeslider'){
            $slider = new Homeslider();
            $slider->title_ar = $request->title_ar;
            $slider->title_en = $request->title_en;
            $slider->color = $request->color;
            $slider->sort = $request->sort;
            $slider->city_id = $city_id;
            $slider->country_id  = $city->country_id ;
            $slider->save();
            return response()->json(['icon' => 'success', 'title' => 'Slider  created successfully'], 200);  

        }elseif($type == 'banner'){
        $slider = new Banner();
        $slider->link = $request->link;
        $slider->homeslider_id = $request->homeslider_id;
        $slider->city_id = $city_id;
        $slider->start_date = $request->start_at;
        $slider->end_date = $request->end_at;
        $image =$request->image;
        $imageName = time() . 'image.' . $image->getClientOriginalExtension();
        $image->move('images/banner', $imageName);
        $slider->image = $imageName;
        $slider->save();
        return response()->json(['icon' => 'success', 'title' => 'Banner  created successfully'], 200);  

    }
        
    }
    
    public function offer_slider($locale,$id,$city_id){
      $homeslider =   Homeslider::find($id);
      $brands = Vendor::with('cities')->whereHas('cities', function ($q) use ($city_id) {
        $q->where('city_id', $city_id);
      })->get();
      $slider_offer = HomesliderOffer::where('homeslider_id',$id)->get();
      return view('dashboard.promo.get_offer', compact('homeslider','brands','slider_offer'));
       
    }
    public function create_offer(Request $request,$locale){
        $offer = new HomesliderOffer();
        $offer->homeslider_id = $request->homeslider_id;
        $offer->vendor_id = $request->vendor_id;
        $offer->offer_id = $request->offer_id;
        $offer->sort = $request->sort;
        $off = Offer::find($request->offer_id);
        $off->is_slider = 1;
        $off->save();
        $offer->save();
        return redirect()->back()->with(['success'=>'تم الاضافة بنجاح']);
    }
    
    public function get_offer_ajax(Request $request,$locale )
    {

       $offers = Offer::where('vendor_id',$request->venodr_id)->get();
       return response()->json($offers);

    }
    public function get_offer_ajax_not_slider(Request $request,$locale )
    {

       $offers = Offer::where('vendor_id',$request->venodr_id)->where('is_slider',0)->get();
       return response()->json($offers);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premotion  $premotion
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $premotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premotion  $premotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $premotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Premotion  $premotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $premotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premotion  $premotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $premotion)
    {
        //
    }
}

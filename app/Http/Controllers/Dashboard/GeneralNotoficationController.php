<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GeneralNotofication;
use App\Models\Offer;
use App\Models\User;
use App\Models\Vendor;
use Notification;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Http\Traits\SendNotification;
use App\Models\City;
use App\Models\Clinet;

class GeneralNotoficationController extends Controller
{
    use SendNotification;
    public function index(){
        return view('dashboard.notofication.general')->with('notofications',GeneralNotofication::with(['vendor','offer'])->get());
    }
    public function create(){
        $vendors = Vendor::where('enterprise_id',auth()->user()->ent_id)->where('status','active')->where('status',1)->get();
       
        $notofications=GeneralNotofication::get();
        return view('dashboard.notofication.general_create',compact('vendors','notofications'));
    }
    public function get_offer($locale,$id){
        $offers = Offer::with('vendor')->where('status',1)->where('vendor_id',$id)->get();
    }
    public function store(Request $request ,$locale){
        $not = new GeneralNotofication();
        $not->title_en = $request->title_en;
        $not->title_ar = $request->title_ar;
        $not->body_en = $request->body_en;
        $not->body_ar = $request->body_ar;
        $not->vendor_id = $request->vendor_id;
        $not->offer_id = $request->offer_id;

        $not->save();
        $users = Clinet::where('token','!=',null)->get();
        foreach($users as $user){
            $this->notification($user->token,  $not->body_ar, $not->title_ar, 'notofication',$not->vendor_id,$not->offer_id);
        }

        return redirect()->back();
    }
    public function create_user_notofication(){
        $users = Clinet::get();
        return view('dashboard.notofication.user_create',compact('users'));
    }
    public function create_city_notofication(){
        $cities = City::where('status',1)->get();
        return view('dashboard.notofication.city',compact('cities'));
    }
    public function create_gender_notofication(){
        return view('dashboard.notofication.gender');
    }
    public function model_city(Request $request){
        $city = City::find($request->id);
        $vendors = Vendor::where('enterprise_id',auth()->user()->ent_id)->where('status','active')->where('status',1)->has('cities')->whereHas('cities', function ($q) use ($request) {
            $q->where('city_id', $request->id);
          })->get();
        return view('dashboard.notofication.city_model',compact('city','vendors'));
    }
    public function model_gender(Request $request){
        $gender = $request->id;
        $vendors = Vendor::where('enterprise_id',auth()->user()->ent_id)->where('status','active')->where('status',1)->get();
        return view('dashboard.notofication.gender_model',compact('gender','vendors'));
    }
    
    public function store_city(Request $request ,$locale){
        $not = new GeneralNotofication();
        $not->title_en = $request->title_en;
        $not->title_ar = $request->title_ar;
        $not->body_en = $request->body_en;
        $not->body_ar = $request->body_ar;
        $not->vendor_id = $request->vendor_id;
        $not->offer_id = $request->offer_id;
        // $not->city_id = $request->city_id;
        $not->save();
        $users = Clinet::where('token','!=',null)->where('city_id',$request->city_id)->get();
        foreach($users as $user){
            $this->notification($user->token,  $not->body_ar, $not->title_ar, 'notofication',$not->vendor_id,$not->offer_id);
        }
        return redirect()->back();
    }
    public function store_gender(Request $request ,$locale){
        $not = new GeneralNotofication();
        $not->title_en = $request->title_en;
        $not->title_ar = $request->title_ar;
        $not->body_en = $request->body_en;
        $not->body_ar = $request->body_ar;
        $not->vendor_id = $request->vendor_id;
        $not->offer_id = $request->offer_id;
        // $not->city_id = $request->city_id;
        $not->save();
        $users = Clinet::where('token','!=',null)->where('gender',$request->gender)->where('city_id',$request->city_id)->get();
        foreach($users as $user){
            $this->notification($user->token,  $not->body_ar, $not->title_ar, 'notofication',$not->vendor_id,$not->offer_id);
        }
        return redirect()->back();
    }

    
    public function store_user_notofication(Request $request , $locale)
    {
        $date =[
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'body_ar' => $request->body_ar,
            'body_en' => $request->body_en,
        ];
        $user = Clinet::find($request->user_id);
        Notification::send($user, new UserNotification($date));
        $not = 'true';
        $this->notification($user->token,  $date['body_ar'], $date['title_ar'], 'notofication',null,null);

        return response()->json(['icon' => 'success', 'title' => 'Notofication send successfully'], $not ? 200 : 400);

        
    }
}

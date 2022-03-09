<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\MapOfferResourses;
use App\Http\Resources\OfferCollection;
use App\Http\Resources\OfferResourses;
use App\Http\Resources\PakegeCollection;
use App\Http\Resources\SocialCollection;
use App\Http\Resources\SuggetstedOfferResourses;
use App\Http\Resources\VednorResourse;
use App\Http\Resources\VendorCoverCollection;
use App\Http\Resources\VendorDetiesResourses;
use App\Http\Resources\VendorOfferDeResourses;
use App\Models\Social;
use App\Models\Subscription;
use App\Models\Vendor;
use Carbon\Carbon;

class OfferController extends BaseController
{

 
    public function offerDetiles(Request $request){
        $offer= Offer::find($request->offer_id);
        if($offer){
            $res['status']= $this->sendResponse('OK');
            $res['data'] = new VendorOfferDeResourses($offer);
            return $res;
        }else{
            $res['status']= $this->SendError();
            return $res;
        }
        
    }
    public function my_fatoorah_credential(){
      $res['status'] = $this->sendResponse200('Create');
      $res['data']['myfatoorah_credentials']['api_key']=get_general('api_key') ;
      $res['data']['myfatoorah_credentials']['base_url']=get_general('base_url') ;
      return $res;
    }
    public function credentials(){
      dd('dd');
    }
    public function package(Request $request){
      
        $pakege = Subscription::with('vendor')->whereHas('vendor', function ($q) use ($request) {
          $q->where('status','active');

            $q->with('enterprise')->whereHas('enterprise', function ($q) use ($request) {
                $q->where('enterprise_id', get_enterprose_uuid(request()->header('uuid')));
              });
           
                 $q->with('counteire')->whereHas('counteire', function ($q) use ($request) {
                    $q->where('country_id', $request->country_id);
                  });
                })->with('enteprice')->orWhereHas('enteprice', function ($q) use ($request) {
           
                    $q->with('counteire')->whereHas('counteire', function ($q) use ($request) {
                       $q->where('country_id', $request->country_id);
                     });
        })->get();
        $res['status']= $this->sendResponse('OK');
        $res['data'] = new PakegeCollection($pakege);
        return $res;
    }
    public function contact(){
        $socials = Social::get();
        $res['status']= $this->sendResponse200('OK');
        $res['data'] = new SocialCollection($socials);
        return $res;
    }
    public function search(Request $request){
        // $socials = Social::get();
        $res['status']= $this->sendResponse('OK');
        $offers = Offer::where('status',1)->where('end_time','>=',Carbon::now())->with('vendor')->whereHas('vendor', function ($q) use ($request) {
          $q->where('status','active');
            $q->with('enterprise')->whereHas('enterprise', function ($q) use ($request) {
                $q->where('enterprise_id', get_enterprose_uuid(request()->header('uuid')));
              });
            $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                   $q->where('city_id', $request->city_id);
                 }); 
                 })->where('name_ar','like','%'.$request->search_key.'%')->orWhere('name_en','like','%'.$request->search_key.'%')->get();

        $stores = Vendor::where('status','active')->with('cities')->whereHas('cities', function ($q) use ($request) {
            $q->where('city_id', $request->city_id);
          }) 
        ->where('name_ar','like','%'.$request->search_key.'%')->orWhere('name_en','like','%'.$request->search_key.'%')->get();

        $res['data']['offers'] =  sort_offer(OfferResourses::collection($offers));
        $res['data']['stores'] =  sort_vendor(VednorResourse::collection($stores));

        return $res;
    }
    public function suggetstd_offer(Request $request)
    {
        $offers = Offer::where('status',1)->where('end_time','>=',Carbon::now())->with('vendor')->whereHas('vendor', function ($q) use ($request) {
          $q->where('status','active');
            $q->with('enterprise')->whereHas('enterprise', function ($q) use ($request) {
                $q->where('enterprise_id', get_enterprose_uuid(request()->header('uuid')));
              });
            $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                   $q->where('city_id', $request->city_id);
                 }); 
                 })->inRandomOrder()->get();
                 $res['status']= $this->sendResponse('OK');
                 $res['data'] = SuggetstedOfferResourses::collection($offers);
                 return $res;
    }
    public function offer_map(Request $request)
    {
        $offers = Offer::where('status',1)->where('end_time','>=',Carbon::now())->with('vendor')->whereHas('vendor', function ($q) use ($request) {
          $q->where('status','active');
            $q->with('enterprise')->whereHas('enterprise', function ($q) use ($request) {
                $q->where('enterprise_id', get_enterprose_uuid(request()->header('uuid')));
              });
            $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                   $q->where('city_id', $request->city_id);
                 }); 
                 })->get();
                 $res['status']= $this->sendResponse('OK');
                 $res['data'] = MapOfferResourses::collection($offers);
                 return $res;
    }
}

<?php

namespace App\Http\Resources;

use App\Models\FavoritOffer;
use App\Models\Transaction;
use App\Models\Vendor;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorOfferResourses extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->lang_name($this),
            'details'=>$this->lang_details($this),
            'terms'=>$this->lang_terms($this),
            'image'=>asset('images/primary_offer/'.@$this->offerimage->primary_image),
            'type'=>$this->typeoffer($this),
            'membership_type'=>strtoupper($this->member_type),
            'start_date'=>$this->start_time,
            'expire_date'=>$this->end_time,
            'before_price'=>$this->offertype->price_befor_discount,
            'price'=> $this->offertype->price != null ? $this->offertype->price : 0 ,
            'percentage'=>$this->offertype->discount_value != null ? $this->offertype->discount_value : 0,
            'client_usage_times'=>$this->usege_member  == 'unlimit' ? null : (int)$this->usage_member_number ,
            'total_usage_times'=> $this->check($this),
            'limit_period_duration'=>null,
            'limit_period_duration'=>null,
            'limit_period_unit'=>null,
            'points_no'=>$this->system_point,
            'store_points_no'=>$this->store_point,
            'is_general'=>0,
            'estimated_saving'=>0,
            'is_favorite'=>$this->is_fav($this),
            'flash_deal'=> (int)$this->is_flashdeal,
            'voucher'=> (int)$this->is_voucher,
            'store_id'=> $this->vendor_id ,
            'is_limited_period_between_redeems'=> 0,
            'period_limit_between_redeems'=> null,
            // 'last_use'=> $this->Timetofferuse($this),
            // 'uses_no'=>  $this->Counttofferuse($this),
            'distance'=>@$this->get_dinstance($this,$request),
            'store'=> new VendorForOfferResourses($this->vendor)  ,
        ];
    }
    public function check($data){
        if (auth('client_api')->check()) {
      $trans = Transaction::where('offer_id',$data->id)->where('client_id',auth('client_api')->id())->count();
      return $trans;
        }else{
            return null;
        }
    }
    public function get_dinstance($data,$request)
    {
        $vendor = Vendor::find($data->vendor_id);
        
        $array =[];
        foreach($vendor->branches->where('status','active') as $branch){
            $value =  get_dinstance($request->latitude,$request->longitude,$branch->latitude,$branch->longitude);
             $di = $value  * 1.609344 ;
             array_push($array,$di);
         }
         if($array != null){
             return min($array);
         }
    }
    public function is_fav($data){
        $fav = FavoritOffer::where('offer_id',$data->id)->where('user_id',auth()->id())->first();
        if($fav){
            return 1;
        }else{
            return 0;
        }
    }
    public function lang_name($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->name_ar;
            } else {
                return $data->name_en;
            }
        } else {
            return $data->name_en;
        }
    }
    public function lang_details($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->desc_ar;
            } else {
                return $data->desc_en;
            }
        } else {
            return $data->desc_en;
        }
    }
    public function lang_terms($data)
    {
        
        $array = [];
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
             
               $items = explode('-',$data->terms_ar);
            foreach($items as $key=>$i){
               array_push($array,$items[$key]);
             }
               return $array;

            } else {
               
                $items = explode('-',$data->terms_en);
             foreach($items as $key=>$i){
                array_push($array,$items[$key]);
              }
                return $array;
            }
        } else {
          
            $items = explode('-',$data->terms_en);
         foreach($items as $key=>$i){
            array_push($array,$items[$key]);
          }
            return $array;
        }
    }
    public function typeoffer($data){
        if($data->offertype->offer_type =='buyOneGetOne'){
            return 'buy_1_get_1';
        }elseif($data->offertype->offer_type =='special_discount'){
            return 'special_discount';
        }elseif($data->offertype->offer_type =='general_offer'){
            return 'general_discount';
        }
    }
}

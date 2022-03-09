<?php

namespace App\Http\Resources;

use App\Models\Subscription;
use App\Models\Subscriptions_User;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoritOfferResourses extends JsonResource
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
            'id'=>@$this->offer->id,
            'name'=>@$this->lang_name($this),
            'price'=>@$this->offer->price,
            'before_price'=>@$this->offer->price_befor_discount,
            'percentage'=>'',
            'expire_date'=>@$this->vendor->end_time,
            'estimated_saving'=>'',
            'type'=>@$this->offer->offer_type,
            'image'=>asset('images/brand/'.@$this->offer->image),
            'membership_type'=>@$this->offer->member_type,
            'offer_id'=>@$this->offer->vendor_id,
            'offer'=> new VendorResourses(@$this->offer->vendor)  ,
            'is_favorite'=>1,
        ];
    }
    public function get_subs($data){
   $subs=  Subscriptions_User::where('user_id',auth()->id())->where('status','active')->orderBy('id', 'desc')->get()->last()->sub_id;
   $subsctiton = Subscription::find($subs);
   return $subsctiton->type_paid;
    }
    public function lang_name($data)
    {
        
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return @$data->vendor->name_ar;
            } else {
                return @$data->vendor->name_en;
            }
        } else {
            return @$data->vendor->name_en;
        }
    }
    public function lang_desc($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return @$data->offer->desc_ar;
            } else {
                return @$data->offer->desc_en;
            }
        } else {
            return @$data->offer->desc_en;
        }
    }
}

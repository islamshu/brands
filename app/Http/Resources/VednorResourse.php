<?php

namespace App\Http\Resources;

use App\Models\FavoritOffer;
use App\Models\FavoritVendor;
use App\Models\VendorReview;
use Illuminate\Http\Resources\Json\JsonResource;

class VednorResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->lang_name($this),
            'description'=>$this->lang_details($this),
            'policy'=>$this->lang_policy($this),
            'logo'=> asset('images/brand/'.$this->image),
            'cover'=>asset('images/vendor_cover/'.@$this->vendor_image->first()->image),
            'email'=>@$this->user->email,
            'phone'=>@$this->user->phone,
            'website'=>@$this->additinal->website,
            'facebook'=>@$this->additinal->facebook,
            'twitter'=>@$this->additinal->twitter,
            'instagram'=>@$this->additinal->instagram,
            'is_pin_required'=>(int)$this->is_pincode,
            'open_from'=>@$this->additinal->open,
            'close_from'=>@$this->additinal->close,
            'is_favorite'=>$this->is_fav($this),
            'transactions_no'=>0,
            'store_recommendations_no'=>0,
            // 'store_covers'=>new VendorCoverCollection($this->vendor_image),
            'store_seen'=>$this->store_seen($this),
            'store_total_review'=>@$this->store_total_review($this),
            // 'offers'=>new VendorOfferDeCollection($this->offers)  ,
            // 'branches'=> new BranchCollection($this->branches),
            'store_reviews'=>new  VendorReviewCollection($this->review)
            

        ];
    }
    public function store_total_review($data)
    {
        return null;
    }
    public function store_seen($data)
    {
        return [
            'id'=>$data->id,
            'seen_no'=>$data->visitor,
        ];
    }
 
    public function is_fav($data){
        $fav = FavoritVendor::where('vendor_id',$data->id)->where('user_id',auth()->id())->first();
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
    public function lang_policy($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->policy_ar;
            } else {
                return $data->policy_en;
            }
        } else {
            return $data->policy_en;
        }
    }

    
}
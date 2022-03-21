<?php

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class SubResoures extends JsonResource
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
            'type'=>$this->type_of_subscribe != null ? $this->type_of_subscribe : 'FREE',
            'points_no'=>$this->points_no,
            'store_points_no'=>$this->store_points_no,
            'offers_saving'=>$this->offers_saving,
            'coupons_saving'=>$this->coupon_saving,
            'used_offers_no'=>$this->used_offers_no,
            'purchases_no'=>$this->purchases_no,
            'credit'=>$this->credit == null ? null : (int)$this->credit,
            'remaining_credit'=>$this->remain == null ? null : (string)$this->remain,
            'expire_date'=>$this->expire_date,
            'start_date'=>$this->start_date,
            'is_unlimited'=>$this->is_unlimited,
            'is_trial'=>$this->is_trial != 0 ? $this->is_trial : null,
            'is_family'=>$this->is_family != 0 ? $this->is_family : null,
            'multiple_accounts_no'=>$this->multiple_accounts_no,
            'actual_accounts_no'=>$this->actual_accounts_no == null ? 0 : $this->actual_accounts_no  ,
        
        ];
    }
}

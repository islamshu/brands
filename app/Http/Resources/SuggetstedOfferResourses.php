<?php

namespace App\Http\Resources;

use App\Models\Vendor;
use Illuminate\Http\Resources\Json\JsonResource;

class SuggetstedOfferResourses extends JsonResource
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
           'offer_id'=>$this->id,
           'store_id'=>$this->vendor_id,
           'offer'=>new NewOfferResourses($this),
           'store'=>new VendorCoverResourses(Vendor::find($this->vendor_id))
       ];
    }
}

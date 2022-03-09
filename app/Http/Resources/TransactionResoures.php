<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResoures extends JsonResource
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
            'id' => $this->id,
            'offer_id' => $this->offer_id,
            'branch_id' => $this->branch_id,
            'store_id' => $this->vendor_id,
            'saving' => 0,
            'created_at' => $this->created_at,
            'offer' => new OfferResourses($this->offer->where('end_time','>=',Carbon::now())),
            'store' => $this->store($this),
        ];
    }
    public function store($data)
    {
        $lang = request()->header('Lang');
        $store['id'] = @$data->vendor->id;
        if ($lang != null) {
            if ($lang == 'ar') {
                $store['name'] = @$data->vendor->name_ar;
            } else {
                $store['name'] = @$data->vendor->name_en;
            }
        } else {
            $store['name'] = @$data->vendor->name_en;
        }
        $store['logo'] = asset('images/brand/' . @$data->vendor->image);
        return $store;
    }
}

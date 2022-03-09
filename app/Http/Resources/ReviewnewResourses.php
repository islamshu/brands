<?php

namespace App\Http\Resources;

use App\Models\Vendor;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewnewResourses extends JsonResource
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
            'stars_no'=>$this->rate,
            'comment'=>$this->comment,
            'created_at'=>$this->created_at,
            'store_id'=>$this->vendor_id,
            'store'=>new VendorForOfferResourses(Vendor::find($this->vendor_id)),
            'store_review_images'=>$this->store_review_images($this),
        ];
    }
    public function store_review_images($data)
    {
       
        if($data->image != null){
            $image = $data->image;
            
            $array = [];
            
            foreach(json_decode($image) as $im){
              $datac =  [
                    'id'=>$data->id,
                    'store_review_id'=>$data->vendor_id,
                    'image'=>asset('vendor_review'.@$im)
                ];
                array_push($array,$datac);
            }
            return $array;
        }else{
            return [];
        }
        
    }
}

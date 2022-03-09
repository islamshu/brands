<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResourses extends JsonResource
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
            'is_city_related'=>1,
            'is_store_related'=>$this->type =='vendor' ? 1 : 0,
            // 'order_no'=>$this->sort ,
            'order_no'=>1 ,
            'city_id'=>$this->city_id,
            'store_id'=>$this->vendor_id,
            'image'=>asset('images/slider/'.$this->image) ,
            // 'image'=>'http://assets.jooy.tahwolapps.com/slider_images/e9y24stMftShU7JJxMunkpVAGQTzuGxVW7DQnGnRgp9wzkIQZqbuRBsCGIWi.png',
            'city'=>new CityResourses(City::select('id')->find($this->city_id)),
            'store'=>new VendorResourses($this->venndor)
        ];
    }
}

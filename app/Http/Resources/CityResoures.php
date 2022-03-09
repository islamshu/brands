<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResoures extends JsonResource
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
           'name'=>$this->lang_name($request),
       ];
    }
    public function lang_name($request){
        $lang = request()->header('Lang');
        if($lang != null){
            if($lang  =='ar'){
                return $this->city_name;
            }else{
                return $this->city_name_english;
  
            }
        }else{
            return $this->city_name_english;

        }
    }
}

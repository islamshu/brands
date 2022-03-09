<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryCollection extends ResourceCollection
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
            'countries' => $this->collection->map(function($data) {
                return [
                'name'=> $this->lang_name($data),
          
                'code'=>$data->alph3code,
                'phone_code'=>$data->country_code,
                'flag'=>$data->flag,
                ];           
            }),
        ];
    }
    public function lang_name($data){
        $lang = request()->header('Lang');
        if($lang != null){
            if($lang  =='ar'){
                return $data->country_name_ar;
            }else{
                return $data->country_name_en;
  
            }
        }else{
            return $data->country_name_en;

        }
    }
}

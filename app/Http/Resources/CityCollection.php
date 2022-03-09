<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'cities' => $this->collection->map(function($data) {
                return [
                'id'=> $data->id,
                'name'=> $this->lang_name($data),
                
                
                'image'=>$data->image,
                ];
              
            }),
        

        ];
      
    }
    public function lang_name($data){
        $lang = request()->header('Lang');
        if($lang != null){
            if($lang  =='ar'){
                return $data->city_name;
            }else{
                return $data->city_name_english;
  
            }
        }else{
            return $data->city_name_english;

        }
    }
}

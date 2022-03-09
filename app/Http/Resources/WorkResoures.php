<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkResoures extends JsonResource
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
            'description'=> $this->lang_name($this),
            'video'=> $this->link,
        ];
    }
    public function lang_name($data){
        $lang = request()->header('Lang');
        if($lang != null){
            if($lang  =='ar'){
                return $data->title_ar;
            }else{
                return $data->title_en;
  
            }
        }else{
            return $data->title_en;
        }
    }
  
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResoures extends JsonResource
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
            'title'=> $this->lang_name($this),
            'content'=> $this->lang_body($this),
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
    public function lang_body($data){
        $lang = request()->header('Lang');
        if($lang != null){
            if($lang  =='ar'){
                return $data->content_ar;
            }else{
                return $data->content_en;
  
            }
        }else{
            return $data->content_ar;
        }
    }
}

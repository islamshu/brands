<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PakegeTowResourses extends JsonResource
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
            'name'=> $this->lang_name($this),
            'description'=>$this->lang_dec($this),
            'is_unlimited'=>$this->number_of_dayes == null ? 1 : 0,
            'coupons_no'=> $this->number_of_dayes == null ? null : $this->balance,
            'duration_id'=>$this->id,
            'is_family'=>0,
            'multible_accounts_no'=>0,
            'image'=>asset('images/coupun/'.$this->image),


        ];
    }
    public function duration($data){
        $type = $data->expire_date_type;
        if($type == 'days'){
            
            return[
                'id'=>$data->id,
                'name' =>$data->number_of_dayes.' Days',
                'period'=>$data->number_of_dayes,
                'unit'=>'DD'
            ] ;
        }elseif($type == 'months'){
            return[
                'id'=>$data->id,
                'name' =>$data->number_of_dayes.' Months',
                'period'=>$data->number_of_dayes,
                'unit'=>'MM'
            ] ;
        }elseif($type == 'years'){
            return[
                'id'=>$data->id,
                'name' =>$data->number_of_dayes.' Years',
                'period'=>$data->number_of_dayes,
                'unit'=>'YY'
            ] ;
        }
        
    }
    public function lang_name($data){
        $lang = request()->header('Lang');
        if($lang != null){
            if($lang  =='ar'){
                return $data->name_ar;
            }else{
                return $data->name_en;
  
            }
        }else{
            return $data->name_ar;

        }
    }
    public function lang_dec($data){
        $lang = request()->header('Lang');
        if($lang != null){
            if($lang  =='ar'){
                return $data->desc_ar;
            }else{
                return $data->desc_en;
  
            }
        }else{
            return $data->desc_en;

        }
    }
}

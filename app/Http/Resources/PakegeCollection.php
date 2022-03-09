<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PakegeCollection extends ResourceCollection
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
            'packages' => $this->collection->map(function($data) {
                return [
                'id'=> $data->id,
                'name'=> $this->lang_name($data),
                'description'=>$this->lang_dec($data),
                'price'=>$data->price,
                'unit'=>$this->expire_date_type($data),
                'duration'=>$this->duration($data),
                'is_unlimited'=>$data->number_of_dayes == null ? 1 : 0,
                'coupons_no'=> $data->balance,
                'stc_payment_link'=> null,
                'payfort_payment_link'=> null,
                
                
                'image'=> asset('images/subscribe/'.$data->image),
                ];
              
            }),
        

        ];
    }
    public function expire_date_type($data){
        $type = $data->expire_date_type;
        if($type == 'days'){
            return 'DD';
        }elseif($type == 'months'){
            return 'MM';
        }elseif($type == 'years'){
            return 'YY';
        }
        
    }
    public function duration($data){
        $type = $data->expire_date_type;
        if($type == 'days'){
            
            return[
                'name' =>$data->number_of_dayes.' Days',
                'period'=>$data->number_of_dayes,
                'unit'=>'DD'
            ] ;
        }elseif($type == 'months'){
            return[
                'name' =>$data->number_of_dayes.' Months',
                'period'=>$data->number_of_dayes,
                'unit'=>'MM'
            ] ;
        }elseif($type == 'years'){
            return[
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

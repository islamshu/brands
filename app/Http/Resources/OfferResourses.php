<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResourses extends JsonResource
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
       'name'=>$this->lang_name($this),
       'details'=>$this->details($this),
       'terms'=>$this->lang_terms($this),
       'image'=>asset('images/primary_offer/'.@$this->offerimage->primary_image),
       'type'=>$this->typeoffer($this),
       'before_price'=>$this->offertype->price_befor_discount,
       'price'=> $this->offertype->price != null ? $this->offertype->price : 0 ,
       'percentage'=>$this->offertype->discount_value != null ? $this->offertype->discount_value : 0,
       'flash_deal'=> (int)$this->is_flashdeal,
       'voucher'=> (int)$this->is_voucher,
       'store_id'=> $this->vendor_id ,
       'store'=> new VendorResourses($this->vendor)  ,
       'distance'=>@$this->get_dinstance($this->vendor,$request),

        ];
    }
    public function get_dinstance($data,$request){
        $array =[];
        foreach($data->branches->where('status','active') as $branch){
           $value =  get_dinstance($request->latitude,$request->longitude,$branch->latitude,$branch->longitude);
            $di = $value  * 1.609344 ;
            array_push($array,$di);
        }
        if($array != null){
            return min($array);
        }
    }
    public function details($data){
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->desc_ar;
            } else {
                return $data->desc_en;
            }
        } else {
            return $data->desc_en;
        } 
    }
    public function lang_terms($data)
    {
        
        $array = [];
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
             
               $items = explode('-',$data->terms_ar);
            foreach($items as $key=>$i){
               array_push($array,$items[$key]);
             }
               return $array;

            } else {
               
                $items = explode('-',$data->terms_en);
             foreach($items as $key=>$i){
                array_push($array,$items[$key]);
              }
                return $array;
            }
        } else {
          
            $items = explode('-',$data->terms_en);
         foreach($items as $key=>$i){
            array_push($array,$items[$key]);
          }
            return $array;
        }
    }
    public function typeoffer($data){
        if($data->offertype->offer_type =='buyOneGetOne'){
            return 'buy_1_get_1';
        }elseif($data->offertype->offer_type =='special_discount'){
            return 'special_discount';
        }elseif($data->offertype->offer_type =='general_offer'){
            return 'general_discount';
        }
    }
    public function lang_name($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->name_ar;
            } else {
                return $data->name_en;
            }
        } else {
            return $data->name_en;
        }
    }
}

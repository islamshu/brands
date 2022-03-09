<?php

namespace App\Http\Resources;

use App\Models\Branch;
use App\Models\FavoritVendor;
use App\Models\Offer;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorForOfferResourses extends JsonResource
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
            'id' => @$this->id,
            'name' => @$this->lang_name($this),
            'description'=>@$this->lang_name_dec($this),
            'logo' => asset('images/brand/' . @$this->image),
            'cover' => asset('images/brand/' . @$this->cover_image),
            'is_favorite' => @$this->is_fav($this),
            'is_top'=>0,
            // 'count_b' => Branch::where('vendor_id',$this->id)->count(),
            // 'count_o' => Offer::where('vendor_id',$this->id)->count(),
            'distance'=>@$this->get_dinstance($this,$request) ? @$this->get_dinstance($this,$request) : 0,
        ];
    }
    public function is_fav($data){
        $fav = FavoritVendor::where('vendor_id',$data->id)->where('user_id',auth()->id())->first();
        if($fav){
            return 1;
        }else{
            return 0;
        }
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
    public function lang_name_dec($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return strip_tags($data->desc_ar);
            } else {
                return strip_tags($data->desc_en);
            }
        } else {
            return strip_tags($data->desc_en);
        }
    }
}

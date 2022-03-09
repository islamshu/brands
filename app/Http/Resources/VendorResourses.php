<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResourses extends JsonResource
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
            'id' => $this->id,
            'name' => $this->lang_name($this),
            'image' => asset('images/brand/' . $this->image),
            'desc' => $this->lang_name_dec($this),
            'owner_name' => $this->owner_name,
            'distance'=>@$this->get_dinstance($this,$request),
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

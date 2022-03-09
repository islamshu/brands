<?php

namespace App\Http\Resources;

use App\Models\Branch;
use Illuminate\Http\Resources\Json\JsonResource;

class MapOfferResourses extends JsonResource
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
            'logo'=>asset('images/brand/'.@$this->image),
            'cover'=>asset('images/brand/'.@$this->image),
            'distance'=>$this->get_distance($this,$request),
            'latitude'=>$this->get_latitude($this),
            'longitude'=>$this->get_longitude($this)

        ];
    }
    public function get_latitude($data){

        $branches = Branch::where('status','active')->where('vendor_id',$data->vendor_id)->get();
        return $branches->min('latitude');
    }
    public function get_longitude($data){

        $branches = Branch::where('status','active')->where('vendor_id',$data->vendor_id)->get();
        return $branches->min('longitude');
    }
    public function get_distance($data,$request){
        $array =[];
        $branches = Branch::where('status','active')->where('vendor_id',$data->vendor_id)->get();
        foreach($branches as $branch){
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
}

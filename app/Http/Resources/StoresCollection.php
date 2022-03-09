<?php

namespace App\Http\Resources;

use App\Models\FavoritVendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StoresCollection extends ResourceCollection
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
            'data' => $this->collection->map(function($data) use($request) {
                return [
                    'id' => @$data->id,
                    'name' => @$this->lang_name($data),
                    'description'=>@$this->lang_name_dec($data),
                    'logo' => asset('images/brand/' . @$data->image),
                    'cover' => asset('images/brand/' . @$data->cover_image),
                    'is_favorite' => @$this->is_fav($data),
                    'is_top'=>@$data->is_top,
                    'distance'=>@$this->get_dinstance($data, $request) ? @$this->get_dinstance($data,$request) : 0,
                ];
              
            }),
        

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
        // dd($request);
        $array =[];
        
        foreach($data->branches as $branch){
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


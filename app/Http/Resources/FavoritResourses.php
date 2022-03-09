<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoritResourses extends JsonResource
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
            'id'=>@$this->vendor->id,
            'name'=>@$this->lang_name($this),
            'logo'=>asset('images/brand/'.@$this->vendor->image),
            'cover'=>asset('images/brand/'.@$this->vendor->cover_image),
            'is_favorite'=>1,
        ];
    }
    public function lang_name($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->vendor->name_ar;
            } else {
                return $data->vendor->name_en;
            }
        } else {
            return $data->vendor->name_en;
        }
    }
}

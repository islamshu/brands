<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorOfferCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $page = $request->last_index +2;
        $limit = $request->has('paginate') ? $request->get('paginate') : 10;
        $Col = VendorOfferResourses::collection($this->collection);
        $datad = [];
        foreach (collect($Col)->sortBy('distance') as $data) {
          array_push($datad, $data);
        }
        return[
            'offers' =>paginate(collect($datad),$limit,$page),
            'category_slider_images'=>[],
        ];
    }
}

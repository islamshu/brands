<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorReviewsNewCollection extends ResourceCollection
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
        $collction =   VendorReviewResourses::collection($this->collection);
        $datad = [];
        foreach (collect($collction)->sortBy('distance') as $data) {
          array_push($datad, $data);
        }
        return[
            'stores' =>paginate(collect($datad),$limit,$page),
        ];
    }
}

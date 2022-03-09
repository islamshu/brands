<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorOfferDeCollection extends ResourceCollection
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
        $collction =   VendorOfferDeResourses::collection($this->collection);
        $datad = [];
        foreach (collect($collction)->sortBy('distance') as $data) {
          array_push($datad, $data);
        }
        return[
            // 'count' => $this->count(),
            // 'total' => $this->total(),
            // 'prev'  => $this->appends(request()->input())->previousPageUrl(), 
            // 'next'  => $this->appends(request()->input())->nextPageUrl(),  
            'offers' => paginate(collect($datad),$limit,$page),
        ];
    }
}

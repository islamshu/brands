<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FavoritCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            // 'count' => $this->count(),
            // 'total' => $this->total(),
            // 'prev'  => $this->appends(request()->input())->previousPageUrl(), 
            // 'next'  => $this->appends(request()->input())->nextPageUrl(),  
            'stores' =>FavoritResourses::collection($this->collection),
        ];
                
    }
}

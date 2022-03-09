<?php

namespace App\Http\Resources;

use App\Http\Resources\PageResoures as ResourcesPageResoures;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PageCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return ResourcesPageResoures::collection($this->collection);
    }
}

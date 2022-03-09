<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqsResourses extends JsonResource
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
            'id'=>$this->id,
            'question'=>$this->qus($this),
            'answer'=>$this->answer($this),
        ];
    }
    public function qus($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->qus_ar;
            } else {
                return $data->qus_en;
            }
        } else {
            return $data->qus_en;
        }
    }
    public function answer($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->answer_ar;
            } else {
                return $data->answer_en;
            }
        } else {
            return $data->answer_en;
        }
    }
}

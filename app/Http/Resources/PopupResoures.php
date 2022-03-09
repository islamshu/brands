<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Popup;
use App\Models\PopupUser;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PopupResoures extends JsonResource
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
            'store_id' => $this->vendor_id,
            'category_id' => $this->categoty_id,
            // 'order_no'=>$this->sort ,
            'content_type' => $this->type_show,
            'content_text' => $this->text,
            'content_image' => asset('images/popup/' . $this->image),
            'show_in' => $this->show_for($this),
            'go_to' => null,
            'subscription_status' => $this->show_as($this),
            'show_for' => $this->num_show,
            'show_for_hours' => $this->number_of_hour,
            'start_date' => $this->start_date,
            'expire_date' => $this->end_date,
            'seen' => $this->seen($this),
            'store' => new VendorResourses(Vendor::find($this->vendor_id)),
            'category' => new CategoryResourses(Category::find($this->categoty_id)),
        ];
    }
    public function seen($data)
    {
        if (auth('client_api')->check()) {
            if($data->num_show =='every_time'){
                return 0;
            }else{
                if($data->num_show == 'once'){
                    $show = PopupUser::where('client_id',auth('client_api')->id())->where('popup_id',$this->id)->first();
                    if($show){
                        return 1;
                    }else{
                        return 0;
                    }
                }elseif($data->num_show == 'hour'){
                    $show = PopupUser::where('created_at', '>', 
                    Carbon::now()->subHours($data->number_of_hour)->toDateTimeString()
                )->first();
                if($show){
                    return 1 ;
                }else{
                    return 0;
                }
                }
            }

        }else{
            return 0;
        }
    }
    function show_for($data)
    {
        if ($data->show_as == 'home') {
            return 'home';
        } elseif ($data->show_as == 'brand') {
            return 'store';
        } elseif ($data->show_as == 'category') {
            return 'category';
        }
    }
    function show_as($data)
    {
        $show = $data->show_for;
        if ($show == 'paid') {
            return 'premium';
        } else {
            return $show;
        }
    }
}

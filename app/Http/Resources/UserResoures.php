<?php

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResoures extends JsonResource
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
            'name'=>$this->username,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'gender'=>$this->gender,
            'birth_date'=>$this->birth_date,
            'image'=>asset($this->image),
            'nationality'=>$this->nationality,
            'is_complete'=>$this->is_complete,
            'is_subscriber'=>$this->is_subscriber,
            'is_new_version'=>1,
            'is_subscriber_in_city'=>0,
            'is_unlimited'=>$this->is_unlimited,
            'is_employee'=>$this->is_unlimited,
            'is_family'=>$this->is_family,
            'multiple_accounts_no'=>$this->multiple_accounts_no,
            'actual_accounts_no'=>$this->actual_accounts_no == null ? 0 : $this->actual_accounts_no  
,
            'country'=>new CountryResoures(Country::find($this->country_id)),
            'city' => @$this->city->neglish_name,
            'subscription'=>new UserSubscription(@$this->sub->id)
        ];
    }
}

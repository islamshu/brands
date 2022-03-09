<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientTwoResoures extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>(int)$this->phone,
            'gender'=>$this->gender,
            'birth_date'=>$this->birth_date == null  ? null :date('Y-m-d', strtotime((string)$this->birth_date)),
            'image'=>asset($this->image),
            'nationality'=>$this->nationality,
            'is_complete'=>(int)$this->is_complete,
            'is_subscriber'=>(int)$this->is_subscriber,
            'is_new_version'=>1,
            'is_subscriber_in_city'=>0,
            'is_unlimited'=>$this->is_unlimited,
            'is_employee'=>(int)$this->is_unlimited,
            'is_family'=>$this->is_family,
            'multiple_accounts_no'=>$this->multiple_accounts_no,
            'actual_accounts_no'=>$this->actual_accounts_no == null ? 0 : $this->actual_accounts_no  
 ,           // 'status'=>$this->status == 'active' ? 1 : 0 ,
            'country'=>new CountryResoures(Country::find($this->country_id)),
            'city' => new CityResoures(City::find($this->city_id)),
        
            'subscription'=>new SubResoures(@$this),
        ];
    }
}

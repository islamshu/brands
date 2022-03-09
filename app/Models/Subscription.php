<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Subscription extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded =[];
    public function subs()
    {
        return $this->belongsToMany(Subscriptions_User::class,'subscriptions_users','sub_id','user_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'brands_id');
    }
    public function enteprice()
    {
        return $this->belongsTo(Enterprise::class, 'enterprises_id');
    }
    public function codes()
    {
        return $this->hasMany(CodeSubscription::class, 'sub_id');
    }
    public function promo()
    {
        return $this->hasMany(DiscountSubscription::class, 'sub_id');
    }
}

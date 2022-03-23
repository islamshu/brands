<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Offer extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
    /**
     * Get the user associated with the Offer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function offerfav()
    {
        return $this->hasMany(FavoritOffer::class, 'offer_id');
    }
    public function offerday()
    {
        return $this->hasOne(Offerdays::class, 'offer_id');
    }
    public function offertype()
    {
        return $this->hasOne(Offertype::class, 'offer_id');
    }
    public function offerimage()
    {
        return $this->hasOne(Offerimage::class, 'offer_id');
    }
    public function offerpromo()
    {
        return $this->hasOne(HomesliderOffer::class, 'offer_id');
    }
    /**
     * Get the user that owns the Offer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    
}

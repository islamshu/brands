<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomesliderOffer extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * Get the user that owns the Slider
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
    public function offers()
    {
        return $this->hasMany(HomesliderOffer::class, 'offer_id');

    }
    public function homslider()
    {
        return $this->belongsTo(Homeslider::class, 'homeslider_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * Get the user that owns the Slider
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function venndor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


}

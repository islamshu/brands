<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Enterprise extends Model
{
    protected $guarded =[];

    use HasFactory,SoftDeletes;
    /**
     * Get the user that owns the Enterprise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currencies()
    {
        return $this->belongsToMany(Currency::class,'currencies_enterprise', 'enterprise_id', 'currency_id');
    }
    public function categorys()
    {
        return $this->belongsToMany(Category::class, 'categories_enterprise', 'enterprise_id', 'category_id');
    }
  
    public function counteire()
    {
        return $this->belongsToMany(Country::class,'enterprise_countries','enterprise_id',  'country_id',);
    }
    public function citis()
    {
        return $this->belongsToMany(City::class,'enterprise_cities','enterprise_id',  'city_id',);
    }

}

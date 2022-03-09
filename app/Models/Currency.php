<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * The roles that belong to the Currency
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function entrorices()
    {
        return $this->belongsToMany('currencies_enterprise', 'enterprise_id', 'currency_id');
    }
}

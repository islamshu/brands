<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enterprise_neighborhood extends Model
{
    protected $table ='enterprise_neighberhoods';
    /**
     * Get the user that owns the enterprise_neighborhood
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id');
    }
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enterprise_city extends Model
{
    
 
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

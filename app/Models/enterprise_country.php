<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enterprise_country extends Model
{
    use HasFactory;
    public function country(){
        return $this->belongsTo(Country::class);
    }
}

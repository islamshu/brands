<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor_neighborhood extends Model
{
    protected $table="vendor_neighberhood";
    public function neighborhood(){
        return $this->belongsTo(Neighborhood::class);
    }
}

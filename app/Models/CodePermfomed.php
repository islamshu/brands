<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodePermfomed extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function codes(){
        return $this->hasMany(Performed::class,'peformed_id');
    }
}

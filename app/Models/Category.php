<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function getTitleAttribute($val)
    {
        $lang = app()->getLocale();
        if($lang == 'ar'){
            return $this->name_ar;
        }else{
            return $this->name_en;

        }

    }
}

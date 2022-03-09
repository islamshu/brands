<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_Permission extends Model
{
    public $timestamps = false;
    protected $guarded=[];


    protected $table = "permission_user";
 
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

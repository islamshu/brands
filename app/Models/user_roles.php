<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_roles extends Model
{
    protected $table = "role_user";
    protected  $primaryKey = 'id';

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions_User extends Model
{
    use HasFactory;
    protected $table ='subscriptions_users';
    protected $guarded=[];
    /**
     * Get the user that owns the Subscriptions_User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Clinet::class);
    }
    public function subscripe()
    {
        return $this->belongsTo(Subscription::class, 'sub_id');
    }
}

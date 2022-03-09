<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Laravel\Passport\HasApiTokens;

class User extends  Authenticatable
{
    use LaratrustUserTrait, Notifiable,SoftDeletes , HasApiTokens;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subs()
    {
        return $this->belongsTo(Subscriptions_User::class,'user_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class, 'ent_id', 'id');
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'vendor_id', 'id');
    }

    public function terms_policies()
    {
        return $this->hasMany('App\Models\TermPolicy', 'user_id', 'id');
    }

    public function questions_memberships()
    {
        return $this->hasMany('App\Models\QuestionMembership', 'user_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function phoneDirectory(){
        return $this->hasMany(PhoneDirectory::class, 'user_id', 'id');
    }

    public function getGroups(){
        return $this->hasMany(Group::class, 'user_id', 'id');
    }

    public function getHistory(){
        return $this->hasMany(History::class, 'user_id', 'id');
    }

    public function plannings(){
        return $this->belongsToMany(Planning::class, 'planning_assigns', 'user_id', 'planning_id');
    }

    public function createdPlanning(){
        return $this->hasMany(Planning::class, 'user_id', 'id');
    }

    public function getFcmid(){
        return $this->hasMany(Fcm::class, 'user_id', 'id');
    }
}

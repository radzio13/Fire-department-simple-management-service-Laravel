<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Profile;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() {
        return $this->role == 'admin';
    }

    public function getPicture() {
        return $this->profile->picture;
    }

    public function hasPicture() {
        if(preg_match('/profilePictures/', $this->profile->picture, $match)) {
            return true;
        } else {
            return false;
        }
    }

     public function getGravatar() {
        $hash = md5(strtolower(trim($this->attributes['email'])));

        return "http://gravatar.com/avatar/$hash";
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }
}

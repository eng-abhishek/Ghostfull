<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'username', 'email', 'address' ,'phone_number','password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuperAdmin()
    {
        return ($this->is_admin == 'Y') ? true : false;
    }

    /**
     * Get the user's avatar.
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        $document_path = 'avatars';
        if($this->avatar != '' && \Storage::exists($document_path.'/'.$this->avatar)){
            return asset('storage/'.$document_path.'/'.$this->avatar);
        }else{
            return asset('assets/backend/images/default-avatar.jpg');
        }
    }
}

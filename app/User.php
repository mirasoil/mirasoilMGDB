<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\ResetPasswordNotification;

class User extends Eloquent implements Authenticatable,CanResetPasswordContract 
{
    use AuthenticatableTrait,CanResetPassword;
    use Notifiable;

    protected $connection = 'mongodb';

    protected $guard = 'user';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'address', 'phone', 'county', 'city', 'zipcode',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}

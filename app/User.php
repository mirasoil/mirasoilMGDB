<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait;
    use Notifiable;

    protected $connection = 'mongodb';

    protected $guard = 'user';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'address', 'phone', 'county', 'city', 'zipcode',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

<?php

namespace App;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model;

class Contact extends Model
{
    protected $connection = 'mongodb';

    public $fillable = ['name', 'email', 'phone', 'subject', 'message'];

}

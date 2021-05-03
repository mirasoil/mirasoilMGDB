<?php

namespace App;

use App\Product;
use Auth;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{ 
    protected $connection = 'mongodb';     //specifies which connection you want to use for the model

    protected $fillable = [
        'user_id', 'billing_fname', 'billing_lname', 'billing_email', 'billing_phone','billing_address',
        'billing_county', 'billing_city', 'billing_zipcode', 'billing_total', 'shipped', 'products'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function products(){
        return $this->embedsMany('App\Product');
    }
}

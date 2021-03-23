<?php

namespace App;
use App\Product;
use Auth;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model;


class Product extends Model
{
    protected $connection = 'mongodb';

    public $fillable = ['id', 'name', 'slug', 'quantity', 'price', 'stock', 'image', 'description', 'properties', 'uses'];
}

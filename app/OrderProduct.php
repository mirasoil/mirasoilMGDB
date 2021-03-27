<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class OrderProduct extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'order_product';

    protected $fillable = ['order_id', 'product_id', 'quantity'];
}

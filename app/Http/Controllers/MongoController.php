<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as Mongo;

class MongoController extends Controller
{
    function mongoConnect() {
        $mongo = new Mongo;
        $connection = $mongo->mirasoilMGDB->miraDB;
        return $connection->find()->toArray();
    }
}

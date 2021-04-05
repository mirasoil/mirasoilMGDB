<?php

namespace App\Http\Controllers;

use App\Product;
use http\Env\Response;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output = "";
            $products = Product::where('name','LIKE','%'.$request->search.'%')->get();
            if($products){  
                foreach ($products as $key => $product) {
                    $output.='<tr>'.
                    '<td><a href="/'.app()->getLocale().'/details/'.$product->slug.'" style="text-decoration:none;">'.$product->name.'</a></td><br>'.
                    '</tr>';
                }
            return Response($output);
            }
        }
    }
}


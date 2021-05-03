<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Auth;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    // Display invoice for user 
    public function show() {
        $order_id = request()->segment(count(request()->segments()));                       //the order id from url
        $orders = Order::where('_id', $order_id)->get();                                    //the order from Orders collection
        
        $customer = new Buyer([                                                             //the user's info from Orders collection
            'name'          => $orders[0]['attributes']['billing_fname'].' '.$orders[0]['billing_lname'],
            'custom_fields' => [
                'email' => $orders[0]['billing_email'],
                'telefon' => $orders[0]['billing_phone'],
                'adresă' => $orders[0]['billing_address'],
                'oraș' => $orders[0]['billing_city'],
                'județ' => $orders[0]['billing_county'],
                'cod poștal' => $orders[0]['billing_zipcode']
            ],
        ]);
        $products = array();
        $quantities = array();
        for($i = 0; $i < count($orders[0]['products']); $i++) {
            $prod = Product::findOrFail($orders[0]['products'][$i]['product_id']);
            $products[] = $prod;

            $qty = $orders[0]['products'][$i]['quantity'];
            $quantities[] = $qty;
        }
        
        $items = [];
        foreach ($products as $product) { 
            for ($i = 0; $i < count($products); $i++) {                                                  //store the quantity that were bought from that specific product 
                if ($product['_id'] == $orders[0]['products'][$i]['product_id']) {                       //if the id from products is equal to the product_id from our collection
                    $quantity = $quantities[$i]; 
                }
                
            }
            $items[] = (new InvoiceItem())->title($product['name'])
                ->quantity($quantity)
                ->pricePerUnit($product['price']);
        }

        $invoice = Invoice::make()
            ->buyer($customer)
            ->dateFormat('d/m/Y')
            ->addItems($items)
            ->logo(public_path('/img/Logo-mirasoil.png'));
        return $invoice->stream();
    }


    // ADMIN - show invoice
    public function showAdmin() {
        $order_id = request()->segment(count(request()->segments()));                       //the order id from url
        $orders = Order::where('_id', $order_id)->first();                                  //the order from Orders collection
        
        $customer = new Buyer([                                                             //the user's info from Orders collection
            'name'          => $orders['billing_fname'].' '.$orders['billing_lname'],
            'custom_fields' => [
                'email' => $orders['billing_email'],
                'telefon' => $orders['billing_phone'],
                'adresă' => $orders['billing_address'],
                'oraș' => $orders['billing_city'],
                'județ' => $orders['billing_county'],
                'cod poștal' => $orders['billing_zipcode']
            ],
        ]);
        
        $products = array();
        $quantities = array();
        for($i = 0; $i < count($orders['products']); $i++) {
            $prod = Product::findOrFail($orders['products'][$i]['product_id']);
            $products[] = $prod;

            $qty = $orders['products'][$i]['quantity'];
            $quantities[] = $qty;
        }
        
        $items = [];
        foreach ($products as $product) { 
            for ($i = 0; $i < count($products); $i++) {                                                //store the quantity that were bought from that specific product 
                if ($product['_id'] == $orders['products'][$i]['product_id']) {                        //if the id from products is equal to the product_id from out collection
                    $quantity = $quantities[$i]; 
                }
                
            }
            $items[] = (new InvoiceItem())->title($product['name'])
                ->quantity($quantity)
                ->pricePerUnit($product['price']);
        }
        // dd($items);
        $invoice = Invoice::make()
            ->buyer($customer)
            ->dateFormat('d/m/Y')
            ->addItems($items)
            ->logo(public_path('/img/Logo-mirasoil.png'));
        return $invoice->stream();
    }
}

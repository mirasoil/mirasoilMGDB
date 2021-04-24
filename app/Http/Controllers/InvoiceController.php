<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderProduct;
use Auth;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    public function showOk() {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->latest()->first();
        $customer = new Buyer([
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
        // dd($customer);
        $products_id = OrderProduct::where('order_id', $orders['_id'])->get();              
        
        $products = array();
        foreach ($products_id as $product_id) {
            $prod = Product::where('_id', $product_id['product_id'])->get();                
            $products[] = $prod;
        }

        $items_array = array();
        for ($i = 0; $i < count($products); $i++) {
            $product = $products[$i][0];                                                   
            $items_array[] = $product;   
        }
        //dd($items);
        //dd($products[2][0]);
        $items = [];
        foreach ($items_array as $item_array) {                                                     
            $order_product = OrderProduct::where('product_id', $item_array['_id'])->get();          
            // dd($order_product[0]['quantity']);
            for ($i = 0; $i < count($order_product); $i++) {                                         
                if ($item_array['_id'] == $order_product[$i]['product_id']) {                       
                    $quantity = $order_product[$i]['quantity'];  
                }
            }
            $items[] = (new InvoiceItem())->title($item_array['name'])
                ->quantity($quantity)
                ->pricePerUnit($item_array['price']);
        }
        
        $invoice = Invoice::make()
            ->buyer($customer)
            ->dateFormat('d/m/Y')
            ->addItems($items)
            ->logo(public_path('/img/Logo-mirasoil.png'));
        return $invoice->stream();
    }

    public function show() {
        $order_id = request()->segment(count(request()->segments()));                       //the order id from url
        $orders = Order::where('_id', $order_id)->get();                                  //the order from Orders collection
        //dd($orders);
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
        //dd($customer);
        $products_id = OrderProduct::where('order_id', $order_id)->get();              //the id of the products from OrderProduct based on the order's id (FK)
        
        $products = array();
        foreach ($products_id as $product_id) {
            $prod = Product::where('_id', $product_id['product_id'])->get();                //the produts from Products collection based on the id from OrderProduct
            $products[] = $prod;
        }
        //dd($products);
        $items_array = array();
        for ($i = 0; $i < count($products); $i++) {
            $product = $products[$i][0];                                                   //all the products which were bought for the current order
            $items_array[] = $product;   
        }
        //dd($items);
        //dd($products[2][0]);
        $items = [];
        // dd($items_array);
        $order_products = [];                                                  //foreach bought product
        $order_products[] = OrderProduct::where(array('order_id' => $order_id), array('product_id' => $items_array[0]['_id']))->get();  //atat order id trebuie sa fie acelasi cat si product id, altfel imi returneaza toate produsele cu id-ul gasit din toate comenzile
        //dd($order_products[0][1]['product_id']);   

        foreach ($items_array as $item_array) { 
            for ($i = 0; $i < count($items_array); $i++) {                                       //store the quantity that were bought from that specific product 
                if ($item_array['_id'] == $order_products[0][$i]['product_id']) {                       //if the id from products is equal to the product_is from OrderProduct
                    $quantity = $order_products[0][$i]['quantity'];  //still has bugs for some orders (increase quantity)
                }
                
            }
            $items[] = (new InvoiceItem())->title($item_array['name'])
                ->quantity($quantity)
                ->pricePerUnit($item_array['price']);
        }
        //dd($items);
        $invoice = Invoice::make()
            ->buyer($customer)
            ->dateFormat('d/m/Y')
            ->addItems($items)
            ->logo(public_path('/img/Logo-mirasoil.png'));
        return $invoice->stream();

    }


    //ADMIN
    public function showAdmin() {
        $order_id = request()->segment(count(request()->segments()));                       //the order id from url
        $orders = Order::where('_id', $order_id)->first();                                  //the order from Orders collection
        // dd($orders);
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
        // dd($customer);
        $products_id = OrderProduct::where('order_id', $orders['_id'])->get();              //the id of the products from OrderProduct based on the order's id (FK)
        
        $products = array();
        foreach ($products_id as $product_id) {
            $prod = Product::where('_id', $product_id['product_id'])->get();                //the produts from Products collection based on the id from OrderProduct
            $products[] = $prod;
        }

        $items_array = array();
        for ($i = 0; $i < count($products); $i++) {
            $product = $products[$i][0];                                                   //all the products which were bought for the current order
            $items_array[] = $product;   
        }
        //dd($items);
        //dd($products[2][0]);
        $items = [];
        foreach ($items_array as $item_array) {                                                     //foreach bought product
            $order_product = OrderProduct::where('product_id', $item_array['_id'])->get();          //give me the related OrderProduct details
            // dd($order_product[0]['quantity']);
            for ($i = 0; $i < count($order_product); $i++) {                                        //store the quantity that were bought from that specific product 
                if ($item_array['_id'] == $order_product[$i]['product_id']) {                       //if the id from products is equal to the product_is from OrderProduct
                    $quantity = $order_product[$i]['quantity'];  //still has bugs for some orders (increase quantity)
                }
            }
            $items[] = (new InvoiceItem())->title($item_array['name'])
                ->quantity($quantity)
                ->pricePerUnit($item_array['price']);
        }
        
        $invoice = Invoice::make()
            ->buyer($customer)
            ->dateFormat('d/m/Y')
            ->addItems($items)
            ->logo(public_path('/img/Logo-mirasoil.png'));
        return $invoice->stream();
    }
}
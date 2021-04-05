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
        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->dateFormat('m/d/Y')
            ->addItem($item);

        return $invoice->stream();
    }

    public function show() {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->first();
        $customer = new Buyer([
            'name'          => $orders['billing_fname'].' '.$orders['billing_lname'],
            'custom_fields' => [
                'email' => $orders['billing_email'],
                'telefon' => $orders['billing_phone'],
                'adresă' => $orders['billing_address'],
                'oraș' => $orders['billing_city'],
                'județ' => $orders['billing_county'],
                'cod poștal' => $orders['billing_zipcode'],
                'total' => $orders['billing_total'],
            ],
        ]);
        // dd($customer);
        $products_id = OrderProduct::where('order_id', $orders['_id'])->get();
        $item = (new InvoiceItem())->title('Factura')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->dateFormat('m/d/Y')
            ->addItem($item);

        return $invoice->stream();
        // $products = array();
        // foreach ($products_id as $product_id) {
        //     $prod = Product::where('_id', $product_id['product_id'])->get();
        //     $products[] = $prod;
        // }
        // //dd($products);
        // $items = array();
        // // foreach ($products as $product) {
        // //     $name = $product['name'];
        // //     $item = (new InvoiceItem())->title($name)->pricePerUnit(2);
        // //     $items = $item;
        // // }
        // for ($i = 0; $i <= 3; $i++) {
        //     dd($products[$i][0]['name']);
        // }
        
    }
}

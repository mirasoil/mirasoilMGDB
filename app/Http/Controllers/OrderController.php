<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use App\Product;
use App\OrderProduct;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //store the order for the logged in user 
    public function store(Request $request){
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_fname' => $request->firstname,
            'billing_lname' => $request->lastname,
            'billing_email' => $request->email,
            'billing_phone' => $request->phone,
            'billing_address' => $request->address,
            'billing_county' => $request->input('county'),
            'billing_city' => $request->city,
            'billing_zipcode' => $request->zipcode,
            'billing_total' => $request->total
        ]);

        $cart = session()->get('cart');
        // Insert into order_product table
        foreach ($cart as $item) {
            $product = Product::where('name', '=', $item['name'])->get();  //nu am acces la id asa ca identific produsul dupa nume - pe viitor modific cosul din sesiune sa imi tina minte si id-ul
            $id = $product->first()->id;
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
            ]);
        }

        return $order;
    }

    //display all the orders for the logged in user
    public function index()  
    {        
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->get();   //din orders toate id-urile comenzilor plasate de utilizatorul cu id-ul $user_id

        $items = array();
        foreach($orders as $order){
            $items[] = OrderProduct::where('order_id', $order->id)->first();     //din order_product toate id-urile produselor corespunzatoare comenzilor cu order_id egal cu id-ul din orders
        }

        $products = array();
        foreach($items as $item){
            $prod = Product::where('id', $item->product_id)->first();   //cautam produsele cu id-ul respectiv si le adaugam in array
            $products[] = $prod;
        }
        return view('orders.myorders', array(
            'orders' => $orders,
            'products' => $products
        ));

        // dd($products);
        
    }

    //details of a specific order
    public function getMyOrderSpecs($id){
        $id = request()->segment(count(request()->segments()));
        $orders = Order::where('_id', $id)->first();
        
        $details = OrderProduct::where('order_id', $id)->get();    //pentru o comanda cu acelasi order id putem avea mai multe produse => array
        // $order_id = OrderProduct::where('id', $id)->get('order_id');
        $product_id = OrderProduct::where('order_id', $id)->get(['product_id']);

        $items = array();
        $products = array();
        foreach($details as $detail){
            $items[] = $detail->product_id;    //array-ul cu toate detaliile din comanda respectiva

            $prod = Product::findOrFail($detail->product_id);   //cautama produsele cu id-ul respectiv si le adaugam in array
            $products[] = $prod;
        }

        return view('orders.myorder', array(
            'orders' => $orders,
            'details' => $details,
            'products' => $products   //returnam toate detaliile referitoare la produsele respective cosului din tabela products
        ));

        // dd($items);
    }

    //ORDERS for ADMIN
    function getOrders(Request $request){

        // $orders = Order::all();

        // return view('orders.orders', array(
        //     'orders' => $orders,
        // ));

        $orders = Order::orderBy('id','DESC')->paginate(5);   //apelam modelul care va face legatura cu BD de unde va afisa produsele - pentru admin
        $value = ($request->input('page',1)-1)*5;    // get the top 5 of all products, ordered by the id of products in descending order
        return view('orders.orders', compact('orders'))->with('i', $value); 
    } 

    // Display all order's details
    public function getOrderSpecs($id){
        $id = request()->segment(count(request()->segments()));
        $orders = Order::where('_id', $id)->get();
        
        $details = OrderProduct::where('order_id', $id)->get();    //pentru o comanda cu acelasi order id putem avea mai multe produse => array
        // $order_id = OrderProduct::where('id', $id)->get('order_id');
        $product_id = OrderProduct::where('order_id', $id)->get(['product_id']);

        $items = array();
        $products = array();
        foreach($details as $detail){
            $items[] = $detail->product_id;    //array-ul cu toate detaliile din comanda respectiva

            $prod = Product::findOrFail($detail->product_id);   //cautama produsele cu id-ul respectiv si le adaugam in array
            $products[] = $prod;
        }

        return view('orders.order', array(
            'orders' => $orders,
            'details' => $details,
            'products' => $products   //returnam toate detaliile referitoare la produsele respective cosului din tabela products
        ));

        // dd($items);
    } 

    // Display form for edit order details
    public function editOrder($id)
    {
        $id = request()->segment(count(request()->segments()));
        $order = Order::find($id)->first();
        return view('orders.edit', compact('order'));
    }

    // Update order details
    public function updateOrder(Request $request)
    {
        $id = request('order_id');
        Order::find($id)->update($request->all());
        return json_encode(array('statusCode'=>200, 'success' => 'Detalii comanda actualizate cu succes!'));
    }

    //Delete an order
    public function destroyOrder(Request $request)
    {
        $id = request('id');
        Order::find($id)->delete();
        return json_encode(array('statusCode'=>200, 'success' => 'Comanda a fost stearsa cu succes!'));
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use App\Product;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //Display all the orders for the logged in user
    public function index()  
    {        
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->get();   //din orders toate id-urile comenzilor plasate de utilizatorul cu id-ul $user_id

        return view('orders.myorders', array(
            'orders' => $orders
        ));      
    }

    //Store the order for the logged in user 
    public function storeOk(Request $request) {  //first order for the logged in user => not working, query gets null
        $query = Order::where('user_id', auth()->user()->id)->latest()->get();
        $query->where('created_at', '<', Carbon::now()->subDays(1)->toDateTimeString());   //If last order was placed less than 24h ago - user cannot place another one
        
        // Creating the order so I can have access to the id
        if (!$query) {
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

            //Get all the products that were ordered with the quantity and store them in an array
            $cart = session()->get('cart');
            $items = [];
            foreach ($cart as $item) {
                
                $product = Product::where('name', '=', $item['name'])->get();  //Get the products from the products collection
                $id = $product->first()->id;
                $items[] = [
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity']
                ];
            }

            //Add the products array to the order
            $order->products = $items;
            $order->save();
            
            return json_encode(array("statusCode"=>200));  
        } else {
            return json_encode(array('statusCode' => 201 , 'orderError' => 'Nu puteti plasa mai multe comenzi intr-un interval de 24h de la ultima comanda'));
        }
    }

    //Get the specific order details
    public function getMyOrderSpecs($id){
        $id = request()->segment(count(request()->segments()));
        $orders = Order::where('_id', $id)->first();

        //Accessing product details from the Products collection
        $products = array();
        for($i = 0; $i < count($orders['products']); $i++) {
            $prod = Product::findOrFail($orders['products'][$i]['product_id']);
            $products[] = $prod;
        }
        // dd($products);

        return view('orders.myorder', array(
            'orders' => $orders,
            'products' => $products   
        ));
    }

    //ORDERS for ADMIN
    function getOrders(Request $request){
        $orders = Order::orderBy('id','DESC')->paginate(5);   //apelam modelul care va face legatura cu BD de unde va afisa produsele - pentru admin
        $value = ($request->input('page',1)-1)*5;    // get the top 5 of all products, ordered by the id of products in descending order
        return view('orders.orders', compact('orders'))->with('i', $value); 
    } 

    // Display all order's details
    public function getOrderSpecs($id){
        $id = request()->segment(count(request()->segments()));
        $orders = Order::where('_id', $id)->get();
        // dd(count($orders[0]['products']));
        $products = array();
        for($i = 0; $i < count($orders[0]['products']); $i++) {
            $prod = Product::findOrFail($orders[0]['products'][$i]['product_id']);
            $products[] = $prod;
        }

        return view('orders.order', array(
            'orders' => $orders,
            'products' => $products   //returnam toate detaliile referitoare la produsele respective cosului din tabela products
        ));

        
    }

    // Display form for edit order details
    public function editOrder($id)
    {
        $id = request()->segment(count(request()->segments()));
        $order = Order::where('_id', $id)->first();
        return view('orders.edit', compact('order'));
    }

    // Update order details
    public function updateOrder(Request $request)
    {
        $id = request('order_id');
        $shipped = $request->shipped;
        Order::where('_id', $id)->update(['shipped' => $request->shipped]);
        return json_encode(array('statusCode'=>200, 'shipped' => $shipped));
    }

    //Delete an order
    public function destroyOrder(Request $request)
    {
        $id = request('id');
        Order::find($id)->delete();
        return json_encode(array('statusCode'=>200, 'success' => 'Comanda a fost stearsa cu succes!'));
    }  
}

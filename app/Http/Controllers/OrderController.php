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
        $orders = Order::where('user_id', $user_id)->latest()->get();   //din orders toate id-urile comenzilor plasate de utilizatorul cu id-ul $user_id

        return view('orders.myorders', array(
            'orders' => $orders
        ));      
    }

    // Create session for order details
    public function createSession(Request $request) {
        $order = json_decode(file_get_contents("php://input"),true);

        $order_info = [
            'firstname' => $order['firstname'],
            'lastname' => $order['lastname'],
            'email' => $order['email'],
            'phone' => $order['phone'],
            'address' => $order['address'],
            'county' => $order['county'],
            'city' => $order['city'],
            'zipcode' => $order['zipcode'],
            'total' => $order['total']
        ];
        session()->put('order_info', $order_info);
        return json_encode(array('statusCode'=>200, 'success' => 'Detalii utilizator actualizate cu succes!'));
    }


    //Store the order for the logged in user 
    public function store(Request $request) {  //first order for the logged in user => not working, query gets null
        $query = Order::where('user_id', auth()->user()->id)->latest()->get();
        $query->where('created_at', '<', Carbon::now()->subDays(1)->toDateTimeString());   //If last order was placed less than 24h ago - user cannot place another one
        $axios = json_decode(file_get_contents("php://input"), true);

        // Creating the order so I can have access to the id
        // if (!$query) {
            $order = Order::create([
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'billing_fname' => session('order_info')['firstname'],
                'billing_lname' => session('order_info')['lastname'],
                'billing_email' => session('order_info')['email'],
                'billing_phone' => session('order_info')['phone'],
                'billing_address' => session('order_info')['address'],
                'billing_county' => session('order_info')['county'],
                'billing_city' => session('order_info')['city'],
                'billing_zipcode' => session('order_info')['zipcode'],
                'billing_total' => session('order_info')['total']
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

            session()->forget('cart');
            
            return json_encode(array("statusCode"=>200));  
        // } else {
        //     return json_encode(array('statusCode' => 201 , 'orderError' => 'Nu puteti plasa mai multe comenzi intr-un interval de 24h de la ultima comanda'));
        // }
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

    public function cancelOrder() {
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST['id'];

        $order = Order::where('_id', $id)->delete();

        return json_encode(array('statusCode'=>200, 'success' => 'Comanda anulata!'));

    }

    //ORDERS for ADMIN
    function getOrders(Request $request){
        $orders = Order::orderBy('created_at','DESC')->paginate(5);   //apelam modelul care va face legatura cu BD de unde va afisa produsele - pentru admin
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
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST['order_id'];
        $shipped = $_POST['shipped'];
        Order::where('_id', $id)->update(['shipped' => $shipped]);
        return json_encode(array('statusCode'=>200, 'success' => 'Status comanda actualizat'));
    }

    //Delete an order
    public function destroyOrder(Request $request)
    {
        $id = request('id');
        Order::find($id)->delete();
        return json_encode(array('statusCode'=>200, 'success' => 'Comanda a fost stearsa cu succes!'));
    }  

    // Test page
    public function testIndex(){
        return view('test');
    }
}

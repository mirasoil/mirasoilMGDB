<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\User;
use Session;
use Jenssegers\Mongodb\Eloquent\Model;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    protected $connection = 'mongodb';

    // Display products page for ADMIN
    public function index(Request $request) 
    {
        $products = Product::orderBy('created_at','DESC')->paginate(5);   
        $value = ($request->input('page',1)-1)*5;
        return view('products.list', compact('products'))->with('i', $value);   
    }

    // Display shop for users and guests 
    public function indexUser(Request $request)  
    {
        $products = Product::orderBy('crested_at','ASC')->paginate(6);   
        $value = ($request->input('page',1)-1)*6;
        return view('pages.shop', compact('products'))->with('i', $value);   
    }

    // Display individual product page, with product details
    public function showUser(Request $request)  
    {
        $slug = request()->segment(count(request()->segments()));
        $shop = Product::where('slug', $slug)->first();
        return view('pages.details', compact('shop'));
    }

    // Add to cart using session
    public function addToCart(Request $request, $id)
    {
        $id = request()->segment(count(request()->segments()));
        $shop = Product::find($request->product);
        if(!$shop) {
            abort(404);
        }
    
        // Check if there already exists a cart in session
        $cart = session()->get('cart');      

        // If there is no cart set we create a new one
        if(!$cart) {
            $cart = [
                $id => [
                    "name" => $shop->name,
                    "quantity" => 1,
                    "price" => $shop->price,
                    "image" => $shop->image
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('cart-success', 'Produs adaugat cu succes!');
        }
        
        // But if there is already a cart in session just increase quantity
        if(isset($cart[$id])) {       
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('cart-success', 'Produs adaugat cu succes!');
        }
        
        // For a new product we add it to cart with a default quantity of 1
        $cart[$id] = [       
            "name" => $shop->name,
            "quantity" => 1,
            "price" => $shop->price,
            "image" => $shop->image
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('cart-success', 'Produs adaugat cu succes!');
    }

    // Update cart quantity
    public function updateCart(Request $request)
    {
        $data = json_decode(file_get_contents("php://input"),true);   
        // var_dump($data["data"]["id"]);
        $id = $data["data"]["id"];
        $quantity = $data["data"]["quantity"];

        if($id and $quantity)
        {
            $cart = session()->get('cart');
            $cart[$id]["quantity"] = $quantity;
            session()->put('cart', $cart);
            session()->flash('cart-success', 'Cos actualizat!');
        }
        return view('pages.cart')->with('cart-success', 'Produs actualizat');
    }

    // Display cart page
    public function cart()
    {
        return view('pages.cart', compact('cart'));
    }

    // Delete product from cart
    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('cart-success', 'Produsul a fost sters.');
        }
    }

    // Empty cart
    public function emptyCart()
    {         
        session()->forget('cart');
        return redirect()->back()->with('cart-success', 'Cosul dumneavoastra de cumparaturi este gol!');
    } 

    // Place order
    public function getCheckout()
    {   
        $cart = session()->get('cart');

        // Only if cart contains products users can place an order
        if(count((array) session('cart')) > 0) {
            return view('pages.revieworder')->with('cart', $cart);
        } else {
            return view('pages.cart');
        }
    }

    // Update user info - revieworder
    public function updateUserInfo(Request $request, $id)
    {
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST['id'];
        User::find($id)->update($request->all());
        return json_encode(array('statusCode'=>200, 'success' => 'Detalii utilizator actualizate cu succes!'));
    }

    //ADMIN resources

    // Display the page for creating a new product
    public function create() 
    {
        return view('products.create');
    }

    // Adding a new product
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required', 
            'slug'=>'required', 
            'quantity'=>'required', 
            'price'=>'required', 
            'stock'=>'required', 
            'image'=>'required', 
            'description'=>'required', 
            'properties'=>'required', 
            'uses'=>'required']);  

        $_POST = json_decode(file_get_contents("php://input"),true);
        $slug= $_POST['slug'];

        $checkSlug = Product::where('slug', $request->slug)->get();     //in case the checkSlug validation in FE fails
        if ($checkSlug->count() > 0) {
            return json_encode(array('statusCode'=>201));
        } else {
            Product::create($request->all());       
            return json_encode(array('statusCode'=>200));
        }
        
    }

    // Check if new entered slug already exists
    public function checkSlug(Request $request) 
    {
        $_POST = json_decode(file_get_contents("php://input"),true);
        $slug = $_POST['slug'];
        if($checkSlug = Product::where('slug', $slug)->first()){
            return json_encode(array('statusCode'=>201));
        } else {    
            return json_encode(array('statusCode'=>200));
        }
        
    }
    public function checkSlugOK(Request $request) 
    {
        $checkSlug = Product::where('slug', $request->slug)->get();
        if ($checkSlug->count() > 0) {
            return json_encode(array('statusCode'=>201));
        } else {    
            return json_encode(array('statusCode'=>200));
        }
    }

    // Display product's details 
    public function show(Request $request, $id) 
    {
        $slug = request()->segment(count(request()->segments()));
        $product = Product::where('slug', $slug)->first();
        return view('products.show', compact('product'));
    }

    // Edit product info
    public function edit($slug) 
    {
        $slug = request()->segments()[2];  //acessing the slug from the link as the 3rd parameter of the array 
        $product = Product::where('slug', $slug)->first();
        return view('products.edit', compact('product'));
    }

    // Modify details for products
    public function update(Request $request, $slug)
    {
        $_POST = json_decode(file_get_contents("php://input"),true);
        $slug = $_POST['slug'];
        $product = Product::where('slug', $slug)->first();        
        $product->update($request->all());
        
        return json_encode(array('statusCode'=>200, 'success' => 'Produs actualizat cu succes!'));
    }

    // Delete products from database
    public function destroy(Request $request)
    {
        $_POST = json_decode(file_get_contents("php://input"),true);
        $slug = $_POST['slug'];

        Product::where('slug', $slug)->delete();

        return json_encode(array('statusCode'=>200, 'successDeleteProduct' => 'Produs sters cu succes!'));
    }

}
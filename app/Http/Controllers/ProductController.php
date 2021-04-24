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

    public function index(Request $request)
    {
        $products = Product::orderBy('created_at','DESC')->paginate(5);   //apelam modelul care va face legatura cu BD de unde va afisa produsele
        $value = ($request->input('page',1)-1)*5;
        return view('products.list', compact('products'))->with('i', $value);     //compact substituie ->with, e o metoda comprimata
    }

    public function indexUser(Request $request)
    {
        $products = Product::orderBy('id','ASC')->paginate(6);   //pentru afisarea paginii de produse din acelasi tabel pentru useri logati
        $value = ($request->input('page',1)-1)*6;
        return view('pages.shop', compact('shop'))->with([
            'products' => $products,
            'i' => $value
        ]);
        //return view('pages.shop', compact('shop'))->with('i', $value);    
    }

    public function indexGuest(Request $request)
    {
        $products = Product::orderBy('crested_at','ASC')->paginate(6);   //pentru afisarea paginii de produse din products pentru vizitatori
        $value = ($request->input('page',1)-1)*6;
        return view('pages.shop', compact('products'))->with('i', $value);   
    }

    public function showUser(Request $request)  //afisarea paginii individuale a produselor conectandu-ne la acelasi model => acelasi tabel (products)
    {
        $slug = request()->segment(count(request()->segments()));
        $shop = Product::where('slug', $slug)->first();
        return view('pages.details', compact('shop'));
    }

    //Adauga in cos - functional
    public function addToCart(Request $request, $id){
        $id = request()->segment(count(request()->segments()));
        $shop = Product::find($request->product);
        if(!$shop) {
        abort(404);
    }
    
    $cart = session()->get('cart');          //verificam daca exista un cos in sesiune
                                            // dacă cart este gol se pune primul product
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
    
    if(isset($cart[$id])) {        // daca cart nu este gol at verificam daca produsul exista pt a incrementa cantitate
        $cart[$id]['quantity']++;
        session()->put('cart', $cart);
        return redirect()->back()->with('cart-success', 'Produs adaugat cu succes!');
    }
    
    $cart[$id] = [       // daca item nu exista in cos at addaugam la cos cu quantity = 1
        "name" => $shop->name,
        "quantity" => 1,
        "price" => $shop->price,
        "image" => $shop->image
    ];
    session()->put('cart', $cart);
    return redirect()->back()->with('cart-success', 'Produs adaugat cu succes!');
    }

    //Actualizare cantitate cos
    public function updateCart(Request $request){
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('cart-success', 'Cos actualizat!');
        }
        return view('pages.cart')->with('cart-success', 'Produs actualizat');
    }

    //Functionalitati useri - parte de cos
    public function cart(){
        return view('pages.cart', compact('cart'));
    }

    //Stergere produs din cos - functional 
    public function destroyCart(Request $request)
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

    //Golire cos - functional
    public function emptyCart(){         
        session()->forget('cart');
        return redirect()->back()->with('cart-success', 'Cosul dumneavoastra de cumparaturi este gol!');
    } 

    public function create()
    {
        return view('products.create');
    }

    //Plasare comanda
    public function getCheckout(){   
        $cart = session()->get('cart');

        if(count((array) session('cart')) > 0) {
            return view('pages.revieworder')->with('cart', $cart);
        }else {
            return view('pages.cart');
        }
    
    }

    //update user info - revieworder
    public function updateUserInfo(Request $request, $id){

        $user = User::findOrFail($request->id)->first();
        $user-> firstname = $request->firstname;
        $user-> lastname = $request->lastname;
        $user-> email = $request->email;
        $user-> address = $request->address;
        $user-> phone = $request->phone;
        $user-> county = $request->county;
        $user-> city = $request->city;
        $user-> zipcode = $request->zipcode;
        $user->save();

    }

    //ADMIN - gestionare produse (resources)
    
    //Adding a new product
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
        
        $checkSlug = Product::where('slug', $request->slug)->get();     //in case the checkSlug validation fails
        if ($checkSlug->count() > 0) {
            return json_encode(array('statusCode'=>201));
        } else {
            Product::create($request->all());       
            return json_encode(array('statusCode'=>200));
        }
        
    }

    //Check if new entered slug already exists
    public function checkSlug(Request $request) {
        $checkSlug = Product::where('slug', $request->slug)->get();
        if ($checkSlug->count() > 0) {
            return json_encode(array('statusCode'=>201));
        } else {
            Product::create($request->all());       
            return json_encode(array('statusCode'=>200));
        }
    }

    public function show(Request $request, $id)
    {
        $slug = request()->segment(count(request()->segments()));
        $product = Product::where('slug', $slug)->first();
        return view('products.show', compact('product'));
    }

    public function edit($slug)
    {
        $slug = request()->segments()[2];  //acessing the slug from the link as the 3rd parameter of the array 
        $product = Product::where('slug', $slug)->first();
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $slug)
    {
        $slug = request('slug');
        $product = Product::where('slug', $slug)->first();        //in model trimitem pentru id-ul specific toate campurile cu date de actualizat
        $product->name = request('name');
        $product->slug = request('slug');
        $product->quantity = request('quantity');
        $product->price = request('price');
        $product->stock = request('stock');
        $product->image = request('image');
        $product->description = request('description');
        $product->properties = request('properties');
        $product->uses = request('uses');
        $product->save();
        // return redirect()->route('products.index', app()->getLocale())->with('success', 'Produs actualizat cu succes!');
        return json_encode(array('statusCode'=>200, 'success' => 'Produs actualizat cu succes!'));
    }

    public function destroy(Request $request)
    {
        $slug = request('slug');
        Product::where('slug', $slug)->delete();
        //return redirect()->route('products.index', app()->getLocale())->with('success', 'Produs sters cu succes!');
        return json_encode(array('statusCode'=>200, 'success' => 'Produs sters cu succes!'));
    }

}
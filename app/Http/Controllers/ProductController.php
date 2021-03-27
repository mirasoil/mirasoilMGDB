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
        $products = Product::orderBy('name','ASC')->paginate(5);   //apelam modelul care va face legatura cu BD de unde va afisa produsele
        $value = ($request->input('page',1)-1)*5;
        return view('products.list', compact('products'))->with('i', $value);     //compact substituie ->with, e o metoda comprimata
    }

    public function indexUser(Request $request)
    {
        $products = Product::orderBy('id','ASC')->paginate(4);   //pentru afisarea paginii de produse din acelasi tabel pentru useri logati
        $value = ($request->input('page',1)-1)*5;
        return view('pages.shop', compact('shop'))->with([
            'products' => $products,
            'i' => $value
        ]);
        //return view('pages.shop', compact('shop'))->with('i', $value);    
    }

    public function indexGuest(Request $request)
    {
        $products = Product::orderBy('id','ASC')->paginate(4);   //pentru afisarea paginii de produse din products pentru vizitatori
        $value = ($request->input('page',1)-1)*5;
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
    public function store(Request $request)
    {
        $this->validate($request, ['name'=>'required', 'slug'=>'required', 'quantity'=>'required', 'price'=>'required', 'stock'=>'required', 'image'=>'required', 'description'=>'required', 'properties'=>'required', 'uses'=>'required']);   //validarea datelor
        //crearea unui produs nou
        Product::create($request->all());       //apelam modelul cu functia predefinita create prin care trimitem toate argumentele
        return redirect()->route('products.index', app()->getLocale())->with('succes', 'Produsul a fost creat cu succes!');
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

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
            'description' => 'required',
            'properties' => 'required',
            'uses' => 'required',
        ]);
        $slug = request()->segments()[2];  //acessing the slug from the link as the 3rd parameter of the array 
        Product::where('slug', $slug)->update($request->all());        //in model trimitem pentru id-ul specific toate campurile cu date de actualizat
        return redirect()->route('products.index', app()->getLocale())->with('success', 'Produs actualizat cu succes!');
    }

    public function destroy()
    {
        $slug = request()->segments()[2];
        Product::where('slug', $slug)->delete();
        return redirect()->route('products.index', app()->getLocale())->with('success', 'Produs sters cu succes!');
    }

}
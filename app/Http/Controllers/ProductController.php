<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
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

    public function showUser(Request $request, $id)  //afisarea paginii individuale a produselor conectandu-ne la acelasi model => acelasi tabel (products)
    {
        dd($request->id);
    }

    //Adauga in cos - functional
    public function addToCart(Product $product){
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($product){    //verificam daca produsul nu este deja in cos
            return $cartItem->id === $product->id;
        });
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('shop', app()->getLocale())->with('success_message', 'Produsul exista deja in cos!'); //cresc cantitatea
        }

        $prod = Product::findOrFail($product->id);   //cautam produsul in baza de date dupa id

        Cart::add(array(                            //il adaugam in Cart
            'id' => $prod->id, 
            'name' => $prod->name,
            'qty' => 1, 
            'price' => $prod->price,
            'weight' => $prod->quantity,
            'options' => ['image' => $prod->image]))
                ->associate('Product');

        //return redirect()->back()->with('success_message', 'Produs adaugat cu succes!');
    }

    //Functionalitati useri - parte de cos
    public function cart(){
        return view('pages.cart');
    }

    //Stergere produs din cos - functional 
    public function destroyCart(Request $request)
    {
        $id = $request->id;

        Cart::remove($id);
    }

    //Golire cos - functional
    public function emptyCart(){         
        Cart::destroy(); 

        return redirect()->back()->with('cart-success', 'Cosul dumneavoastra de cumparaturi este gol!');
    } 

    public function create()
    {
        return view('products.create');
    }

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
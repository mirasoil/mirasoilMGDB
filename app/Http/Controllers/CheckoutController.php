<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use App\Order;
use App\Product;
use App\User;
use App\OrderProduct;
use Auth;
use Session;

class CheckoutController extends Controller
{
    public function index(){
        return view('pages.checkout');
    }

    public function charge(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
        
            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
        
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1999,
                'currency' => 'ron'
            ));
        
            return redirect()->route('checkout.index', app()->getLocale())->with('paymentSuccessfull', 'Va multumim. Plata s-a realizat cu succes! Urmariti statusul comenzii pentru mai multe detalii');
        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->route('checkout.index', app()->getLocale())->with('paymentDeclined', 'A intervenit o eroare. Va rugam reincercati');
        }
    }
        
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;

class NewsletterController extends Controller
{
    public function create()
    {
        return view(app()->getLocale().'#footer-section');
    }

    public function store(Request $request)
    {
        if ( ! Newsletter::isSubscribed($request->email) ) 
        {
            Newsletter::subscribePending($request->email);
            return redirect()->to(app()->getLocale().'#footer-section')->with('subscribe-success', 'Ai fost abonat cu succes!');
        }
        return redirect()->to(app()->getLocale().'#footer-section')->with('subscribe-failure', 'Se pare ca adresa introdusa este deja abonata.');
            
    }
}

<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', app()->getLocale())->name('/');


Route::group([
    'prefix' => '{locale}', 
    'where' => ['locale' => '[a-zA-Z]{2}'], 
    'middleware' => 'setLocale'], function() {

    Route::get('/', function(){
        return view('welcome');
    });
    
    //View pentru pagina despre noi - ruta este /about care apeleaza view-ul about din subdirectorul pages
    Route::get('/about', function(){
        return view('pages.about');
    })->name('about');

    //View pentru pagina prelucrare - ruta este /manufacture care apeleaza view-ul manufacture din subdirectorul pages
    Route::get('/manufacture', function(){
        return view('pages.manufacture');
    })->name('manufacture');

    //Pagina de transport, vizibila pentru oricine
    Route::get('/transport', function(){
        return view('pages.transport');
    })->name('transport');

    //Pagina de informatii utile, vizibila pentru oricine
    Route::get('/info', function(){
        return view('pages.info');
    })->name('info');

    Route::get('/details/{id}', 'ProductController@showUser')->name('details');

    //pentru formularul de contact de pe pagina principala
    Route::get('/contact', 'ContactUsFormController@createForm');
    Route::post('/contact', 'ContactUsFormController@ContactUsForm')->name('contact.store');

    //pentru newsletter - parte de backend, redirectarea se face pe pagina de home la sectiunea contact
    Route::get('newsletter', 'NewsletterController@create');
    Route::post('newsletter', 'NewsletterController@store');

    Auth::routes();

    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
    Route::get('/login/user', 'Auth\LoginController@showUserLoginForm')->name('login.default');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
    Route::get('/register/user', 'Auth\RegisterController@showUserRegisterForm')->name('register.user');
    
    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::post('/login/user', 'Auth\LoginController@userLogin')->name('login.default');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register');
    Route::post('/register/user', 'Auth\RegisterController@createUser')->name('register');
    
    Route::view('/home', 'home')->middleware('auth');
    Route::view('/admin', 'admin')->name('admin');
    Route::view('/user', 'user');
    
    Route::middleware(['auth:admin'])->group(function () { 
        Route::GET('/products', 'ProductController@index');
        Route::resource('products','ProductController');

        //View pentru pagina specifica fiecarui produs - ruta este /products/id-ul produsului care apeleaza view-ul show din subdirectorul products
        Route::get('/products/{id}', function(){
            return view('products.show');
        });    
    
    
    });
    
    Route::middleware(['auth:user'])->group(function () {
            Route::GET('/shop', 'ProductController@indexUser')->name('shop');
            Route::post('add-to-cart/{product}', 'ProductController@addToCart')->name('shop.store');   //add to cart
            Route::get('/cart', 'ProductController@cart')->name('cart');  //cosul propriu zis - user
            Route::delete('/delete-from-cart', 'ProductController@destroyCart')->name('shop.destroy');
            Route::get('cart/success', 'ProductController@emptyCart');  //golire cos
            //Route::get('/details/{id}', 'ProductController@showUser')->name('details');
    
            Route::get('/user', 'UserController@index')->name('user');    //pagina de dashboard pentru useri, formularul de update al datelor
            Route::patch('user/{id}', 'UserController@update');    //modificarea propriu-zisa a datelor in tabela dupa id-ul userului
    
    
    });
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::redirect('/', app()->getLocale())->name('/');


Route::group([
    'prefix' => '{locale}', 
    'where' => ['locale' => '[a-zA-Z]{2}'], 
    'middleware' => 'setLocale'], function() {

    Route::get('/', function(){
        return view('welcome');
    })->name('home');
    
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
    Route::get('/contact', 'ContactUsFormController@createForm')->name('contact');
    Route::post('/contact', 'ContactUsFormController@ContactUsForm')->name('contact.store');

    //pentru newsletter - parte de backend, redirectarea se face pe pagina de home la sectiunea contact
    Route::get('/newsletter', 'NewsletterController@create')->name('newsletter');
    Route::post('/newsletter', 'NewsletterController@store');

    //for search bar
    Route::get('/search', 'SearchController@search')->name('search');

    Auth::routes();

    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
    Route::get('/login/user', 'Auth\LoginController@showUserLoginForm')->name('login.default');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
    Route::get('/register/user', 'Auth\RegisterController@showUserRegisterForm')->name('register.user');
    
    Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('login.admin');
    Route::post('/login/user', 'Auth\LoginController@userLogin')->name('login.default');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register');
    Route::post('/register/user', 'Auth\RegisterController@createUser')->name('register');
    
    Route::view('/admin', 'admin')->name('admin');
    Route::view('/user', 'user')->name('user.dashboard');
    
    Route::middleware(['auth:admin'])->group(function () { 
        Route::GET('/products', 'ProductController@index')->name('products');
        Route::resource('products','ProductController');

        //View pentru pagina specifica fiecarui produs - ruta este /products/id-ul produsului care apeleaza view-ul show din subdirectorul products
        Route::get('/products/{id}', function(){
            return view('products.show');
        })->name('products.view'); 
        
        Route::post('check', 'ProductController@checkSlug')->name('slug.check');

        //orders
        Route::get('orders', 'OrderController@getOrders')->name('orders');   //display all orders
        Route::get('order/{id}', 'OrderController@getOrderSpecs')->name('order.details');
        Route::get('order/edit/{id}', 'OrderController@editOrder')->name('order.edit');
        Route::patch('order/edit/{id}', 'OrderController@updateOrder')->name('orders.update');
        Route::delete('order/{id}', 'OrderController@destroyOrder')->name('order.destroy');
    
        //users
        Route::get('users', 'UserController@getUsers')->name('users');
        Route::get('user/{id}', 'UserController@getUserDetails')->name('user.show');
        Route::get('user/edit/{id}', 'UserController@editUser')->name('user.edit');
        Route::patch('user/edit/{id}', 'UserController@updateUser')->name('user.update');
        Route::delete('user/{id}', 'UserController@destroyUser')->name('user.destroy');

        Route::get('/invoices/{id}', 'InvoiceController@showAdmin')->name('invoice.admin');
    
    });
    
    Route::middleware(['auth:user'])->group(function () {
            Route::GET('/shop', 'ProductController@indexUser')->name('shop');
            Route::post('/add-to-cart/{product}', 'ProductController@addToCart')->name('shop.store');   //add to cart
            Route::get('/cart', 'ProductController@cart')->name('cart');  //cosul propriu zis - user
            Route::patch('/update-cart', 'ProductController@updateCart')->name('update-cart');  //modific cos
            Route::delete('/delete-from-cart', 'ProductController@deleteProduct')->name('shop.destroy');
            Route::get('cart/success', 'ProductController@emptyCart')->name('cart.success');  //golire cos
            Route::get('/revieworder', 'ProductController@getCheckout')->name('revieworder'); //pentru confirmarea comenzii
            Route::patch('/revieworder/{id}', 'ProductController@updateUserInfo')->name('review-details'); //pentru pagina de revieworder, actualizare date utilizator
            Route::post('/orders', 'OrderController@store')->name('orders.store');

            //pagina pentru istoricul comenzilor
            Route::get('/myorders', 'OrderController@index')->name('myorders');
            Route::get('/myorder/{id}', 'OrderController@getMyOrderSpecs')->name('myorder');
    
            Route::get('/user', 'UserController@index')->name('user');    //pagina de dashboard pentru useri, formularul de update al datelor
            Route::patch('user/{id}', 'UserController@update');    //modificarea propriu-zisa a datelor in tabela dupa id-ul userului
            Route::post('user', 'UserController@updateAvatar')->name('update.avatar');
    
            //generating invoice
            // Route::get('/checkout', 'InvoiceController@show')->name('invoice.show');
            // Route::post('/checkout/{id}', 'InvoiceController@show')->name('invoice.display');
            // Route::get('/invoice', 'InvoiceController@show')->name('invoice.show');
            Route::get('/invoice/{id}', 'InvoiceController@show')->name('invoice.display');
            Route::get('/csrf', function() {
                echo csrf_token(); 
            })->name('csrf');

    });

    Route::group(['middleware' => ['guest']], function () {
        //Magazin - doar vizualizare pentru guest
        Route::GET('/shop', 'ProductController@indexUser')->name('shop');
    });
});


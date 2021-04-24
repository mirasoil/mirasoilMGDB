<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Http\Request;
use Auth;
use Session;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:user')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) && $request->locale == "en") {

            return redirect()->intended('/en/admin');
        } else if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) && $request->locale == "ro") {

            return redirect()->intended('/ro/admin');
        }

        return back()->withErrors(['password' => 'Parolă sau email invalide'])->withInput($request->only('email', 'remember'));
    }

    public function showUserLoginForm()
    {
        return view('auth.login', ['url' => 'user']);
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        // dd(Session::has('shop-session'));
        if (Session::has('shop-session')) {
            if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) && $request->locale == "en") {

                return redirect()->intended('/en/shop');
            } else if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) && $request->locale == "ro") {

                return redirect()->intended('/ro/shop');
            }
        } else {
            if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) && $request->locale == "en") {

                return redirect()->intended('/en/user');
            } else if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) && $request->locale == "ro") {

                return redirect()->intended('/ro/user');
            }
        }
        return back()->withErrors(['password' => 'Parolă sau email invalide'])->withInput($request->only('email', 'remember'));
    }

    public function redirectTo()
    {
        return app()->getLocale() . '/';
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Admin;
use App\Http\Controllers\Controller;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:user');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // protected function create(array $data) {
    //     return User::create([
    //         'firstname' => $data['firstname'],
    //         'lastname' => $data['lastname'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function showAdminRegisterForm() {
        return view('auth.register', ['url' => 'admin']);
    }

    public function showUserRegisterForm() {
        return view('auth.register', ['url' => 'user']);
    }

    protected function createAdmin(Request $request) {
        $this->validator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }

    protected function createUser(Request $request) {
        $this->validator($request->all())->validate();
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        if($request->locale == "ro") {
            return redirect()->intended('ro/login/user');
        } else if($request->locale == "en") {
            return redirect()->intended('en/login/user');
        }
    }

    public function redirectTo() {
        return app()->getLocale() .'/';
    }
}

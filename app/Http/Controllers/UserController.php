<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();
        //var_dump($user);

        return view('user');
    }

    public function update(Request $request, $id){

        //dd($request->id);
        $user = User::findOrFail($request->id);
        $user-> firstname = $request->firstname;
        $user-> lastname = $request->lastname;
        $user-> email = $request->email;
        $user-> address = $request->address;
        $user-> phone = $request->phone;
        $user-> county = $request->county;
        $user-> city = $request->city;
        $user-> zipcode = $request->zipcode;
        $user->save();

        return redirect()->back()->with('user-success', 'Informatiile au fost actualizate!');
    }

    // Display all the users
    public function getUsers(Request $request){
        $users = User::orderBy('lastname','ASC')->paginate(3); 
        $value = ($request->input('page',1)-1)*3;
        return view('users.list', compact('users'))->with('i', $value); 
    }

    // Display user details
    public function getUserDetails($id){
        $id = request()->segment(count(request()->segments()));
        $user = User::where('_id', $id)->first();
        return view('users.show', compact('user'));

        // dd($items);
    } 
    
    // Edit a user's details
    public function editUser($id)
    {
        $id = request()->segment(count(request()->segments()));
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }


    // Update user details
    public function updateUser(Request $request, $id)
    {
        $id = request()->segment(count(request()->segments()));
        $this->validate($request, [
            'phone' => 'required',
            'address' => 'required',
            'county' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
        ]);
        User::find($id)->update($request->all());        //in model trimitem pentru id-ul specific toate campurile cu date de actualizat
        return redirect()->route('users', app()->getLocale())->with('success', 'Detalii utilizator actualizate cu succes!');
        // dd($request->all());
    }

    // Delete a user
    public function destroyUser($id)
    {
        $id = request()->segment(count(request()->segments()));
        User::find($id)->delete();
        return redirect()->route('users', app()->getLocale())->with('success', 'Utilizator sters cu succes!');
    }

}

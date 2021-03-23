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
        $users = User::orderBy('id','DESC')->paginate(3); 
        $value = ($request->input('page',1)-1)*3;
        return view('users.list', compact('users'))->with('i', $value); 
    }
    
    // Edit a user's details
    public function editUser($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    // Delete a user
    public function destroyUser($id)
    {
        User::find($id)->delete();
        return redirect()->route('users', app()->getLocale())->with('success', 'Utilizator sters cu succes!');
    }

    // Display user details
    public function getUserDetails($id){
        $user = User::find($id);
        return view('users.show', compact('user'));

        // dd($items);
    } 

    // Update user details
    public function updateUser(Request $request, $id)
    {
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

}

<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use Image;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();
        //var_dump($user);

        return view('user');
    }

    public function updateAvatar(Request $request) {
        //Handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = Auth::user()->id . '.' . $avatar->getClientOriginalExtension();                   //profile picture is saved with a unique name, userId + image extension
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

        }
        return view('user');
    }

    public function update(Request $request){

        //dd($request->id);
        $id = request('user_id');
        $user = User::findOrFail($id);
        $user-> firstname = $request->firstname;
        $user-> lastname = $request->lastname;
        $user-> email = $request->email;
        $user-> address = $request->address;
        $user-> phone = $request->phone;
        $user-> county = $request->county;
        $user-> city = $request->city;
        $user-> zipcode = $request->zipcode;
        $user->save();

        return json_encode(array('statusCode'=>200));
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
        $orders = Order::where('user_id', $id)->get();
            return view('users.show', array(
                'user' => $user,
                'orders' => $orders));

        // dd($orders);
    } 
    
    // Displays the user edit view
    public function editUser($id)
    {
        $id = request()->segment(count(request()->segments()));         
        $user = User::find($id);                                    //finds the user in the database using the url's 3rd segment (the id)
        return view('users.edit', compact('user'));
    }


    // Update user details
    public function updateUser(Request $request, $id)
    {
        $id = request('user_id');
        User::find($id)->update($request->all());
        return json_encode(array('statusCode'=>200, 'success' => 'Detalii utilizator actualizate cu succes!'));
    }

    // Delete a user
    public function destroyUser(Request $request)
    {
        $id = request('id');
        User::find($id)->delete();
        return json_encode(array('statusCode'=>200, 'success' => 'Utilizator sters cu succes!'));
    }

}

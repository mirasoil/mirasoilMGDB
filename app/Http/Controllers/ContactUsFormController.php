<?php

namespace App\Http\Controllers;
use App\Contact;

use Illuminate\Http\Request;

class ContactUsFormController extends Controller
{
    // Create Contact Form
    public function createForm(Request $request) {
        return view('contact');
      }

    // Store Contact Form data
    public function ContactUsForm(Request $request) {
  
        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'message' => 'required'
         ]);

        //  Store data in database
        Contact::create($request->all());


        //  Send mail to admin
      \Mail::send('mail', array(
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'subject' => $request->subject,
          'user_query' => $request->message,
      ), function($message) use ($request){
          $message->from($request->email);
          $message->to('mirasoilproduction@gmail.com', 'Admin')->subject($request->subject);
      });

      return json_encode(array('statusCode'=>200));
    }

    // Display messages from database
    public function showMessages(Request $request){
        $messages = Contact::orderBy('created_at','DESC')->paginate(3);
        $value = ($request->input('page',1)-1)*3;

        return view('pages.messages', compact('messages'))->with('i', $value); 
    }

    // Delete message from database
    public function deleteMessage(Request $request){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST['id'];

        Contact::where('_id', $id)->delete();

        return json_encode(array('statusCode'=>200, 'successDeleteMessage' => 'Mesaj sters cu succes!'));
    }
  
}

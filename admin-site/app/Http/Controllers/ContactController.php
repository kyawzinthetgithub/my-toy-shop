<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Psr\Log\LoggerTrait;
use Validator;

class ContactController extends Controller
{
    // customer contact message
    public function customerContact(Request $request){
        $this->checkContact($request);
        Contact::create([
            'user_id' => $request->userId,
            'contact_message' => $request->message
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }

    //get contact message from customer
    public function getContactMessage(){
        $messages = Contact::select('contacts.*','users.name as user_name','users.email as user_email')->leftJoin('users','contacts.user_id','users.id')->orderBy('created_at','desc')->paginate(5);
        return view('admin.other.customerContact',compact('messages'));
    }

    //delete message
    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#contactMessage')->with(['deleted' => 'Message Delete Success !']);
    }



    //___________________________________________________________________________________________________________________________

    // check message validation
    private function checkContact($request){
        Validator::make($request->all(),[
            'name' => 'required|exists:users,name|unique:users,name,'.$request->userId,
            'email' => 'required|exists:users,email|unique:users,email,'.$request->userId,
            'message' => 'required|min:12|max:255'
        ],[
            'name.unique' => 'User name not match.',
            'email.unique' => 'User email not match.'
        ])->validate();
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

use\App\Events\NewMessage;

class ContactsController extends Controller
{
    public function get()
    {
        $contacts = User::where('id','!=',auth()->user()->id)->get();
        return response()->json($contacts);
    }
    public function getMessageFor($id)
    {
        $messages = Message::where('from',$id)->orWhere('to',$id)->get();
        return response()->json($messages);
    }
    public function send(Request $request){
        $message = new Message;
        $message->to = $request->contact_id;
        $message->from = auth()->id();
        $message->text = $request->text;
        $message->save();

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::all();
        $user2 = User::find(2);
        $s = 5;
        //dd($user2->getChat(),$s);
        // $message = Message::where('sendeder_id', auth()->user()->id)
        // ->orwhere('receiver_id', auth()->user()->id)->get();
        return view('chat', compact('users'));
    }
    public function show($id)
    {
        $id = (int)$id;
        $user = User::find($id);
        //dd($user);
        $messages = Message::where('user_id', auth()->user()->id)->where('receiver_id', $id)
        ->orwhere('receiver_id', auth()->user()->id)->where('user_id',$id)->get();
        $users= User::all();  
        return view('chats.show',['messages'=>$messages, 'show'=>$user, 'users'=>$users]);
    }
    public function store(Request $request){
        $request->validate([
            $request->send => 'required',
        ]);
        
        //return return redirect()->back()->withErrors($validator)->withInput();
    }
    
}
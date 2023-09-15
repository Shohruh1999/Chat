<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public  function index(){
        $users = User::all();
        $user2= User::find(2);
        $s=5;
        //dd($user2->getChat(),$s);
        // $message = Message::where('sendeder_id', auth()->user()->id)
        // ->orwhere('receiver_id', auth()->user()->id)->get();
        return view('chat', compact('users'));
    }
    //
}
